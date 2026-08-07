<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\HariLibur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesAnalysisExport;
use Codedge\Fpdf\Fpdf\Fpdf;

class MonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $cabangId = $request->input('cabang');
        $user = Auth::user();
        $cabangs = Cabang::all();

        $role = optional($user->roles()->first())->id;

        // Get distinct years from attendances for filter
        $years = DB::table('attendances')
            ->selectRaw('DISTINCT YEAR(created_at) as year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        if ($years->isEmpty()) {
            $years = collect([date('Y')]);
        }

        $sales = $this->getSalesData($year, $cabangId);

        return view('back.monthlyreport.index', compact('years', 'cabangs', 'sales', 'year', 'role', 'cabangId'));
    }

    private function getSalesData($year, $cabangId)
    {
        $user = Auth::user();
        $role = optional($user->roles()->first())->id;

        // Tentukan role yang dibolehkan
        // 1 = Admin, 9 = Manager Sales, 10 = Logistik, 5 = Sales, 8 = Driver
        if (in_array($role, [1, 9])) {
            $getIdRolesSalesOrManager = [5, 8];
        } elseif ($role == 10) {
            $getIdRolesSalesOrManager = [8]; // Logistik only sees Driver
        } else {
            $getIdRolesSalesOrManager = [5];
        }
        $roleList = implode(',', $getIdRolesSalesOrManager);

        // Tentukan cabang target
        $targetCabangId = (in_array($role, [1, 9]) && $cabangId) ? $cabangId : $user->cabang_id;

        // Ambil semua user, filter sesuai cabang
        $users = User::select('id', 'name', 'cabang_id')->get();
        if ($role == 10) {
            // Logistik sees all branches' drivers
            $getUsers = $users->pluck('id');
        } else {
            $getUsers = $users->where('cabang_id', $targetCabangId)->pluck('id');
        }
        $userIdsStr = $getUsers->implode(',');

        // Buat kondisi filter ID user
        if ((in_array($role, [1, 9, 10]) && $cabangId && $userIdsStr) || $role === 8) {
            $idManagerExclude = "IN({$userIdsStr})";
        } elseif (in_array($role, [1, 9, 10]) && $cabangId && ! $userIdsStr) {
            $idManagerExclude = "";
        } else {
            $idManagerExclude = "NOT IN(1,13,20,36)";
        }

        $sales = [];

        if (! empty($userIdsStr) || $idManagerExclude === "NOT IN(1,13,20,36)") {
            $sales = DB::select("
                SELECT u.id, u.name, r.name as role, c.cabang as nama_cabang, c.id as cabang_id, 
                       (SELECT COUNT(*) FROM users u2 
                        INNER JOIN model_has_roles mhr2 ON mhr2.model_id = u2.id 
                        WHERE u2.cabang_id = u.cabang_id AND mhr2.role_id IN ($roleList) AND u2.id $idManagerExclude AND u2.status = 1
                       ) as user_count
                FROM users u
                INNER JOIN model_has_roles mhr ON mhr.model_id = u.id
                INNER JOIN roles r ON mhr.role_id = r.id
                LEFT JOIN cabang c ON c.id = u.cabang_id
                WHERE r.id IN ($roleList) AND u.id $idManagerExclude AND u.status = 1
                ORDER BY user_count DESC, c.cabang ASC, u.name ASC
            ");

            $saleIds = array_column($sales, 'id');
            if (!empty($saleIds)) {
                $placeholders = implode(',', array_fill(0, count($saleIds), '?'));
                $yearlyVisits = DB::select("
                    SELECT j.user_id, j.date, COUNT(*) as daily_count
                    FROM jadwals j
                    INNER JOIN detail_jadwals dj ON j.id = dj.jadwal_id
                    INNER JOIN laporan_sales l ON l.jadwal_id = j.id
                    INNER JOIN general_informations g ON l.general_id = g.id AND dj.general_id = g.id
                    INNER JOIN attendances a_in ON a_in.user_id = j.user_id AND a_in.general_id = g.id AND DATE(a_in.created_at) = j.date AND a_in.status = 'check in'
                    INNER JOIN attendances a_out ON a_out.user_id = j.user_id AND a_out.general_id = g.id AND DATE(a_out.created_at) = j.date AND a_out.status = 'check out'
                    WHERE j.user_id IN ($placeholders)
                    AND YEAR(j.date) = ?
                    AND dj.deleted_at IS NULL 
                    AND dj.activity_type = 'Visit'
                    AND (
                        TIMESTAMPDIFF(MINUTE, a_in.created_at, a_out.created_at) >= 20
                        OR
                        (SELECT COUNT(*) FROM laporan_sales ls2 WHERE ls2.general_id = g.id AND ls2.id < l.id) = 0
                    )
                    GROUP BY j.user_id, j.date
                ", array_merge($saleIds, [$year]));

                $userStats = [];
                foreach ($yearlyVisits as $v) {
                    if (!isset($userStats[$v->user_id])) $userStats[$v->user_id] = 0;
                    $userStats[$v->user_id] += min($v->daily_count, 4);
                }

                foreach ($sales as $sale) {
                    $sale->actual_yearly = $userStats[$sale->id] ?? 0;
                    $sale->target_yearly = 960;
                    $sale->percentage_yearly = ($sale->target_yearly > 0) ? min(100, round(($sale->actual_yearly / $sale->target_yearly) * 100, 1)) : 0;
                }
            }
        }
        return $sales;
    }

    public function exportExcel(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $cabangId = $request->input('cabang');
        $sales = $this->getSalesData($year, $cabangId);

        return Excel::download(new SalesAnalysisExport($sales, $year), "Analisis_Sales_{$year}.xlsx");
    }

    public function exportPdf(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $cabangId = $request->input('cabang');
        $sales = $this->getSalesData($year, $cabangId);

        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $fpdf->SetFont('Arial', 'B', 16);
        $fpdf->Cell(0, 10, "LAPORAN ANALISIS SALES TAHUN {$year}", 0, 1, 'C');
        $fpdf->Ln(5);

        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->SetFillColor(230, 230, 230);
        $fpdf->Cell(45, 8, 'Nama Sales', 1, 0, 'C', true);
        $fpdf->Cell(35, 8, 'Cabang', 1, 0, 'C', true);
        $fpdf->Cell(25, 8, 'Role', 1, 0, 'C', true);
        $fpdf->Cell(30, 8, 'Actual / Target', 1, 0, 'C', true);
        $fpdf->Cell(30, 8, 'Percentage', 1, 0, 'C', true);
        $fpdf->Cell(25, 8, 'Status', 1, 1, 'C', true);

        $fpdf->SetFont('Arial', '', 9);
        foreach ($sales as $sale) {
            $status = 'Poor';
            if ($sale->percentage_yearly >= 80) $status = 'Excellent';
            elseif ($sale->percentage_yearly >= 50) $status = 'Good';

            $fpdf->Cell(45, 7, substr(ucwords(strtolower($sale->name)), 0, 25), 1);
            $fpdf->Cell(35, 7, substr($sale->nama_cabang ?? '-', 0, 20), 1);
            $fpdf->Cell(25, 7, $sale->role, 1);
            $fpdf->Cell(30, 7, "{$sale->actual_yearly} / {$sale->target_yearly}", 1, 0, 'C');
            $fpdf->Cell(30, 7, "{$sale->percentage_yearly}%", 1, 0, 'C');
            $fpdf->Cell(25, 7, $status, 1, 1, 'C');
        }

        return response($fpdf->Output('S'), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "attachment; filename=Analisis_Sales_{$year}.pdf");
    }

    public function getMonthlyStats(Request $request)
    {
        $userId = $request->userId;
        $year   = $request->year ?? date('Y');
        $targetMonthly = $request->input('target', 80);

        $monthlyData = [];

        // Fetch all holidays for the year
        $holidays = HariLibur::whereYear('tanggal', $year)->pluck('tanggal')->toArray();

        for ($m = 1; $m <= 12; $m++) {
            $startDate = Carbon::create($year, $m, 1)->startOfMonth();
            $endDate   = Carbon::create($year, $m, 1)->endOfMonth();

            $targetVisits = $targetMonthly;

            // Fetch actual visits for this month
            // Based on DashboardReportController logic: activity_type = 'Visit', checkin & checkout present, minutes >= 20
            $visits = DB::select("
                SELECT DATE(j.date) as visit_date, COUNT(*) as visit_count
                FROM jadwals j
                INNER JOIN detail_jadwals dj ON j.id = dj.jadwal_id
                INNER JOIN laporan_sales l ON l.jadwal_id = j.id
                INNER JOIN general_informations g ON l.general_id = g.id AND dj.general_id = g.id
                INNER JOIN attendances a_in ON a_in.user_id = j.user_id AND a_in.general_id = g.id AND DATE(a_in.created_at) = j.date AND a_in.status = 'check in'
                INNER JOIN attendances a_out ON a_out.user_id = j.user_id AND a_out.general_id = g.id AND DATE(a_out.created_at) = j.date AND a_out.status = 'check out'
                WHERE j.user_id = ? 
                AND dj.deleted_at IS NULL 
                AND dj.activity_type = 'Visit'
                AND j.date BETWEEN ? AND ?
                AND (
                    TIMESTAMPDIFF(MINUTE, a_in.created_at, a_out.created_at) >= 20
                    OR
                    (SELECT COUNT(*) FROM laporan_sales ls2 WHERE ls2.general_id = g.id AND ls2.id < l.id) = 0
                )
                GROUP BY DATE(j.date)
            ", [$userId, $startDate->format('Y-m-d'), $endDate->format('Y-m-d')]);

            $actualVisits = 0;
            foreach ($visits as $v) {
                $actualVisits += min($v->visit_count, 4);
            }

            $percentage = $targetVisits > 0 ? ($actualVisits / $targetVisits) * 100 : 0;

            $monthlyData[] = [
                'month' => $startDate->format('M'),
                'target' => $targetVisits,
                'actual' => $actualVisits,
                'percentage' => round($percentage, 2)
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $monthlyData
        ]);
    }
}
