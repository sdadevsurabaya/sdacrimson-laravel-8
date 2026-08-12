<?php

namespace App\Http\Controllers\Laporan;

use App\Models\User;
use App\Models\Jadwal;
use App\Models\LaporanSales;
use App\Models\General_model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportJourneyPlanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->hasRole('Logistik')) {
            $users = User::role('Driver')->pluck('name', 'id');
        } else {
            $users = User::pluck('name', 'id');
        }

        return view('reportsales.journey-plan', compact('users'));
    }

    public function indexReport(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        $userId = $request->user;
        $startDate = Carbon::parse($request->start)->startOfDay();
        $endDate = Carbon::parse($request->end)->endOfDay();

        $user = User::findOrFail($userId);

        // Get all visit reports for the user in the filter period.
        // is_first_visit uses the exact same subquery as DashboardReportController
        // to ensure "customer baru" is consistent across all reports.
        $laporan = DB::select("
            SELECT
                l.id AS laporan_id,
                l.general_id,
                g.nama_usaha,
                j.date AS visit_date,
                NOT EXISTS (SELECT 1 FROM laporan_sales ls2
                 WHERE ls2.general_id = l.general_id
                   AND ls2.user_id = l.user_id
                   AND ls2.id < l.id) AS is_first_visit
            FROM laporan_sales l
            INNER JOIN jadwals j ON l.jadwal_id = j.id
            INNER JOIN general_informations g ON l.general_id = g.id
            WHERE l.user_id = ?
              AND j.date BETWEEN ? AND ?
            ORDER BY j.date ASC
        ", [$userId, $startDate->toDateString(), $endDate->toDateString()]);

        // Build list of month labels for the pivot header
        $months = [];
        $tempDate = $startDate->copy()->startOfMonth();
        while ($tempDate->lte($endDate)) {
            $months[] = $tempDate->format('M Y');
            $tempDate->addMonth();
        }

        $pivotData = [];

        foreach ($laporan as $item) {
            $customerId   = $item->general_id;
            $customerName = $item->nama_usaha ?? 'Unnamed Customer';
            $monthKey     = Carbon::parse($item->visit_date)->format('M Y');
            $isFirstVisit = (bool) $item->is_first_visit;

            if (!isset($pivotData[$customerId])) {
                $pivotData[$customerId] = [
                    'name'             => $customerName,
                    'months'           => array_fill_keys($months, 0),
                    'total'            => 0,
                    // is_new = true only when this laporan is the very first visit ever
                    // AND that first visit falls within the filter date range
                    'is_new'           => $isFirstVisit,
                    'first_visit_month'=> $monthKey,
                ];
            }

            $pivotData[$customerId]['months'][$monthKey]++;
            $pivotData[$customerId]['total']++;
        }


        // Calculate Totals per month
        $monthlyGrandTotal = array_fill_keys($months, 0);
        $overallTotal = 0;
        foreach ($pivotData as $data) {
            foreach ($data['months'] as $m => $count) {
                $monthlyGrandTotal[$m] += $count;
            }
            $overallTotal += $data['total'];
        }

        // Analisa Calculations
        $totalVisits = $overallTotal;
        $totalCustomers = count($pivotData);
        $totalNewCustomers = 0;
        $singleVisitCustomers = 0;
        $newCustPerMonth = array_fill_keys($months, 0);
        foreach($pivotData as $data) {
            if ($data['is_new']) {
                $totalNewCustomers++;
                // Count new customer only in the month they were FIRST visited
                $firstMonth = $data['first_visit_month'];
                if (isset($newCustPerMonth[$firstMonth])) {
                    $newCustPerMonth[$firstMonth]++;
                }
            }
            if ($data['total'] == 1) $singleVisitCustomers++;
        }

        $workDays = count($months) * 20;

        $avgVisitsPerDay = $workDays > 0 ? round($totalVisits / $workDays) : 0;
        $avgNewCustPerDay = $workDays > 0 ? round($totalCustomers / $workDays) : 0;

        // Trend calculation (simplified: compare last month to previous month if available)
        $trend = "Data is stable";
        if (count($months) >= 2) {
            $lastMonth = $months[count($months) - 1];
            $prevMonth = $months[count($months) - 2];
            if ($monthlyGrandTotal[$lastMonth] > $monthlyGrandTotal[$prevMonth]) {
                $trend = "Trend visit naik dari bulan ke bulan berikutnya";
            } elseif ($monthlyGrandTotal[$lastMonth] < $monthlyGrandTotal[$prevMonth]) {
                $trend = "Trend visit menurun dibandingkan bulan sebelumnya";
            }
        }

        $analysis = [
            'trend' => $trend,
            'new_cust_count' => $totalNewCustomers,
            'single_visit_count' => $singleVisitCustomers,
            'total_customers' => $totalCustomers,
            'avg_new_cust' => $avgNewCustPerDay,
            'total_visits' => $totalVisits,
            'avg_visits' => $avgVisitsPerDay,
            'period_months' => count($months)
        ];

        return view('reportsales.journey-plan-result', compact(
            'user', 
            'startDate', 
            'endDate', 
            'months', 
            'pivotData', 
            'monthlyGrandTotal', 
            'overallTotal',
            'analysis',
            'newCustPerMonth'
        ));
    }
}
