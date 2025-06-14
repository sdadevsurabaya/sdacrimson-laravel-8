<?php
namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\HariLibur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year  = $request->input('year', date('Y'));
        $user  = Auth::user();

        $role = $user->roles()->first()->id;
        // dump($role);

        // $arrayDateOff = ['2025-05-01', '2025-05-12', '2025-05-29'];
        // $arrayDateOff = HariLibur::all();
        $arrayDateOff = HariLibur::whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->get()
            ->toArray();
        $weeks = $this->getCalendarWeeks($month, $year, $arrayDateOff);

        $getIdRolesSalesOrManager = $role !== null && $role == 9 || $role == 1 ? 'IN(5,8)' : 'IN(5)';
        $users                    = User::select('id', 'name', 'cabang_id')->get();
        $getUsers                 = $users->where('cabang_id', $user->cabang_id)->pluck('id');
        $userIdsString            = $getUsers->implode(',');
        $idManagerExclude         = $role !== null && $role == 8 ? "IN({$userIdsString})" : "NOT IN(1,13,36)";

        $sales = DB::select("SELECT u.id, u.name, r.name as role FROM users as u
        INNER JOIN model_has_roles as mhr ON mhr.model_id = u.id
        INNER JOIN roles as r ON mhr.role_id = r.id
        WHERE r.id {$getIdRolesSalesOrManager} AND u.id {$idManagerExclude}");

        $startDate = date("$year-$month-01");
        $endDate   = date("Y-m-t", strtotime($startDate)); // akhir bulan

        $agendas = [];

        foreach ($sales as $sale) {
            $result = DB::select("
            SELECT
                u.id AS user_id,
                u.NAME,
                j.id AS jadwal_id,
                j.DATE AS date,
                dj.id AS dj_id,
                dj.activity_type,
                dj.note AS catatan,
                g.id AS general_id,
                g.nama_usaha AS customer,
                l.id AS laporan_id,
                l.pesan AS laporan_kunjungan,
                l.latitude,
                l.longitude,
                a_in.id AS checkin_id,
                a_in.foto AS checkin_foto,
                a_in.STATUS AS checkin_status,
                a_in.latitude AS checkin_latitude,
                a_in.longitude AS checkin_longitude,
                a_in.created_at AS checkin_time,
                a_out.id AS checkout_id,
                a_out.foto AS checkout_foto,
                a_out.STATUS AS checkout_status,
                a_out.latitude AS checkout_latitude,
                a_out.longitude AS checkout_longitude,
                a_out.created_at AS checkout_time
                FROM
                users u
                INNER JOIN jadwals j ON j.user_id = u.id
                INNER JOIN detail_jadwals dj ON j.id = dj.jadwal_id
                INNER JOIN laporan_sales l ON l.jadwal_id = j.id
                INNER JOIN general_informations g ON l.general_id = g.id
                AND dj.general_id = g.id
                LEFT JOIN attendances a_in ON a_in.user_id = u.id
                AND a_in.general_id = g.id
                AND DATE(a_in.created_at) = j.DATE
                AND a_in.STATUS = 'check in'
                LEFT JOIN attendances a_out ON a_out.user_id = u.id
                AND a_out.general_id = g.id
                AND DATE(a_out.created_at) = j.DATE
                AND a_out.STATUS = 'check out'
            WHERE u.id = ? AND dj.deleted_at IS NULL AND j.date BETWEEN ? AND ?
        ", [$sale->id, $startDate, $endDate]);

            foreach ($result as $agenda) {
                $dateKey                        = date('Y-m-d', strtotime($agenda->date));
                $agendas[$sale->id][$dateKey][] = $agenda;
            }
        }

        //dump($agendas);

        // return view('back.coba', compact('month', 'year', 'weeks', 'sales', 'agendas','arrayDateOff'));
        return view('back.dashboardreport', compact('month', 'year', 'weeks', 'sales', 'agendas', 'arrayDateOff'));
    }

    private function getCalendarWeeks($month, $year, $arrayOff)
    {
        // Buat lookup tanggal => keterangan
        $offMap = [];
        foreach ($arrayOff as $item) {
            $offMap[$item['tanggal']] = $item['keterangan'];
        }

        $weeks    = [];
        $firstDay = strtotime("$year-$month-01");
        $start    = strtotime("monday this week", $firstDay);

        if (date('N', $firstDay) == 1) {
            $start = $firstDay;
        }

        $end = strtotime("last day of $year-$month");
        $end = strtotime("saturday this week", $end); // Akhiri di Sabtu

        while ($start <= $end) {
            $week = [];
            for ($i = 0; $i < 6; $i++) { // Senin–Sabtu
                $dayDate   = strtotime("+$i day", $start);
                $isInMonth = date('n', $dayDate) == $month;

                if ($isInMonth && date('w', $dayDate) != 0) { // Lewati Minggu
                    $fullDate = date('Y-m-d', $dayDate);
                    $isOff    = isset($offMap[$fullDate]);

                    $week[] = [
                        'day'           => jddayofweek(date('w', $dayDate), 1),
                        'date'          => date('j/n', $dayDate),
                        'full'          => $fullDate,
                        'off'           => $isOff,
                        'keteranganOff' => $isOff ? $offMap[$fullDate] : null,
                    ];
                } else {
                    $week[] = null; // Placeholder
                }
            }
            $weeks[] = $week;
            $start   = strtotime("+7 days", $start);
        }

        return $weeks;
    }

}
