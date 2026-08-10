<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\HariLibur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardReportController extends Controller
{
    public function index(Request $request)
    {
        $month    = $request->input('month', date('m'));
        $year     = $request->input('year', date('Y'));
        $cabangId = $request->input('cabang');
        $user     = Auth::user();
        $cabangs  = Cabang::all();

        $role = optional($user->roles()->first())->id;

        $arrayDateOff = HariLibur::whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->get()
            ->toArray();

        $weeks = $this->getCalendarWeeks($month, $year, $arrayDateOff);

        // Tentukan role yang dibolehkan
        // 1 = Admin, 9 = Manager Sales, 10 = Logistik, 5 = Sales, 8 = Driver
        if (in_array($role, [1, 9])) {
            $getIdRolesSalesOrManager = [5, 8];
        } elseif ($role == 10) {
            $getIdRolesSalesOrManager = [8]; // Logistik only sees Driver
        } else {
            $getIdRolesSalesOrManager = [5];
        }
        $roleList                 = implode(',', $getIdRolesSalesOrManager);

        // Tentukan cabang target
        $targetCabangId = (in_array($role, [1, 9]) && $cabangId) ? $cabangId : $user->cabang_id;

        // Ambil semua user, filter sesuai cabang
        $users      = User::select('id', 'name', 'cabang_id')->get();
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
            $idManagerExclude = "NOT IN(1,13,36)";
        }

        // Default sales kosong
        $sales = [];

        // Jika ada user yang valid atau mode exclude
        if ((! empty($userIdsStr) && in_array($role, [1, 9, 10, 8])) || $idManagerExclude === "NOT IN(1,13,36)") {
            if (empty($idManagerExclude)) $idManagerExclude = "NOT IN(1,13,36)";
            $sales = DB::select("
            SELECT u.id, u.name, r.name as role
            FROM users u
            INNER JOIN model_has_roles mhr ON mhr.model_id = u.id
            INNER JOIN roles r ON mhr.role_id = r.id
            WHERE r.id IN ($roleList) AND u.id $idManagerExclude AND u.status = 1
        ");
        }

        // Periode bulan
        $startDate = "$year-$month-01";
        $endDate   = date("Y-m-t", strtotime($startDate));

        // Inisialisasi agenda
        $agendas = [];

        // Proses agenda jika ada sales
        if (! empty($sales)) {
            foreach ($sales as $sale) {
                $result = DB::select("
                SELECT
                    u.id AS user_id,
                    u.name,
                    j.id AS jadwal_id,
                    j.date AS date,
                    dj.id AS dj_id,
                    dj.activity_type,
                    dj.note AS catatan,
                    g.id AS general_id,
                    (SELECT COUNT(*) FROM laporan_sales ls2 WHERE ls2.general_id = g.id AND ls2.user_id = l.user_id AND ls2.id < l.id) = 0 AS is_first_visit,
                    g.nama_usaha AS customer,
                    l.id AS laporan_id,
                    l.pesan AS laporan_kunjungan,
                    l.latitude,
                    l.longitude,
                    a_in.id AS checkin_id,
                    a_in.foto AS checkin_foto,
                    a_in.status AS checkin_status,
                    a_in.latitude AS checkin_latitude,
                    a_in.longitude AS checkin_longitude,
                    a_in.created_at AS checkin_time,
                    a_out.id AS checkout_id,
                    a_out.foto AS checkout_foto,
                    a_out.status AS checkout_status,
                    a_out.latitude AS checkout_latitude,
                    a_out.longitude AS checkout_longitude,
                    a_out.created_at AS checkout_time
                FROM users u
                INNER JOIN jadwals j ON j.user_id = u.id
                INNER JOIN detail_jadwals dj ON j.id = dj.jadwal_id
                INNER JOIN laporan_sales l ON l.jadwal_id = j.id
                INNER JOIN general_informations g ON l.general_id = g.id AND dj.general_id = g.id
                LEFT JOIN attendances a_in ON a_in.user_id = u.id AND a_in.general_id = g.id AND DATE(a_in.created_at) = j.date AND a_in.status = 'check in'
                LEFT JOIN attendances a_out ON a_out.user_id = u.id AND a_out.general_id = g.id AND DATE(a_out.created_at) = j.date AND a_out.status = 'check out'
                WHERE u.id = ? AND dj.deleted_at IS NULL AND j.date BETWEEN ? AND ?
            ", [$sale->id, $startDate, $endDate]);

                foreach ($result as $agenda) {
                    $dateKey                        = date('Y-m-d', strtotime($agenda->date));
                    $agendas[$sale->id][$dateKey][] = $agenda;
                }
            }
        }

        return view('back.dashboardreport', compact(
            'month',
            'year',
            'weeks',
            'sales',
            'agendas',
            'arrayDateOff',
            'cabangs',
            'role'
        ));
    }

    // public function index(Request $request)
    // {
    //     $month    = $request->input('month', date('m'));
    //     $year     = $request->input('year', date('Y'));
    //     $cabangId = $request->input('cabang', null);
    //     $user     = Auth::user();
    //     $cabangs  = Cabang::all();

    //     $role = $user->roles()->first()->id;
    //     // dump($role);

    //     $arrayDateOff = HariLibur::whereMonth('tanggal', $month)
    //         ->whereYear('tanggal', $year)
    //         ->get()
    //         ->toArray();
    //     $weeks = $this->getCalendarWeeks($month, $year, $arrayDateOff);

    //     $getIdRolesSalesOrManager = $role !== null && $role == 9 || $role == 1 ? 'IN(5,8)' : 'IN(5)';
    //     $users                    = User::select('id', 'name', 'cabang_id')->get();
    //     $targetCabangId           = $role && $role == 9 || $role == 1 && $cabangId ? $cabangId : $user->cabang_id;
    //     $getUsers                 = $users->where('cabang_id', $targetCabangId)->pluck('id');
    //     $userIdsString            = $getUsers->implode(',');
    //     $idManagerExclude         = ($role !== null && $role == 9 || $role == 1 && $cabangId && $userIdsString) || ($role !== null && $role == 8) ? "IN({$userIdsString})" : (($role !== null && $role == 9 || $role == 1 && $cabangId && !$userIdsString) ? "" : "NOT IN(1,13,36)");

    //     $sales = DB::select("SELECT u.id, u.name, r.name as role FROM users as u
    //     INNER JOIN model_has_roles as mhr ON mhr.model_id = u.id
    //     INNER JOIN roles as r ON mhr.role_id = r.id
    //     WHERE r.id {$getIdRolesSalesOrManager} AND u.id {$idManagerExclude}");

    //     $startDate = date("$year-$month-01");
    //     $endDate   = date("Y-m-t", strtotime($startDate)); // akhir bulan

    //     $agendas = [];

    //     foreach ($sales as $sale) {
    //         $result = DB::select("
    //         SELECT
    //             u.id AS user_id,
    //             u.NAME,
    //             j.id AS jadwal_id,
    //             j.DATE AS date,
    //             dj.id AS dj_id,
    //             dj.activity_type,
    //             dj.note AS catatan,
    //             g.id AS general_id,
    //             g.nama_usaha AS customer,
    //             l.id AS laporan_id,
    //             l.pesan AS laporan_kunjungan,
    //             l.latitude,
    //             l.longitude,
    //             a_in.id AS checkin_id,
    //             a_in.foto AS checkin_foto,
    //             a_in.STATUS AS checkin_status,
    //             a_in.latitude AS checkin_latitude,
    //             a_in.longitude AS checkin_longitude,
    //             a_in.created_at AS checkin_time,
    //             a_out.id AS checkout_id,
    //             a_out.foto AS checkout_foto,
    //             a_out.STATUS AS checkout_status,
    //             a_out.latitude AS checkout_latitude,
    //             a_out.longitude AS checkout_longitude,
    //             a_out.created_at AS checkout_time
    //             FROM
    //             users u
    //             INNER JOIN jadwals j ON j.user_id = u.id
    //             INNER JOIN detail_jadwals dj ON j.id = dj.jadwal_id
    //             INNER JOIN laporan_sales l ON l.jadwal_id = j.id
    //             INNER JOIN general_informations g ON l.general_id = g.id
    //             AND dj.general_id = g.id
    //             LEFT JOIN attendances a_in ON a_in.user_id = u.id
    //             AND a_in.general_id = g.id
    //             AND DATE(a_in.created_at) = j.DATE
    //             AND a_in.STATUS = 'check in'
    //             LEFT JOIN attendances a_out ON a_out.user_id = u.id
    //             AND a_out.general_id = g.id
    //             AND DATE(a_out.created_at) = j.DATE
    //             AND a_out.STATUS = 'check out'
    //         WHERE u.id = ? AND dj.deleted_at IS NULL AND j.date BETWEEN ? AND ?
    //     ", [$sale->id, $startDate, $endDate]);

    //         foreach ($result as $agenda) {
    //             $dateKey                        = date('Y-m-d', strtotime($agenda->date));
    //             $agendas[$sale->id][$dateKey][] = $agenda;
    //         }
    //     }

    //     //dump($agendas);

    //     // return view('back.coba', compact('month', 'year', 'weeks', 'sales', 'agendas','arrayDateOff'));
    //     return view('back.dashboardreport', compact('month', 'year', 'weeks', 'sales', 'agendas', 'arrayDateOff', 'cabangs', 'role'));
    // }

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
            $week    = [];
            $hasDays = false;
            for ($i = 0; $i < 6; $i++) { // Senin–Sabtu
                $dayDate   = strtotime("+$i day", $start);
                $isInMonth = date('n', $dayDate) == $month;

                if ($isInMonth && date('w', $dayDate) != 0) { // Lewati Minggu
                    $hasDays  = true;
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

            if ($hasDays) {
                $weeks[] = $week;
            }

            $start = strtotime("+7 days", $start);
        }

        return $weeks;
    }

    public function yearly(Request $request)
    {
        $year     = $request->input('year', date('Y'));
        $cabangId = $request->input('cabang');
        $user     = Auth::user();
        $cabangs  = Cabang::all();

        // Get distinct years from jadwals table
        $years = DB::table('jadwals')
            ->selectRaw('DISTINCT YEAR(date) as year')
            ->whereNotNull('date')
            ->orderBy('year', 'DESC')
            ->pluck('year')
            ->toArray();

        // If no years in database, use current year
        if (empty($years)) {
            $years = [date('Y')];
        }

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
        $roleList                 = implode(',', $getIdRolesSalesOrManager);

        // Tentukan cabang target
        $targetCabangId = (in_array($role, [1, 9]) && $cabangId) ? $cabangId : $user->cabang_id;

        // Ambil semua user, filter sesuai cabang
        $users      = User::select('id', 'name', 'cabang_id')->get();
        if ($role == 10) {
            // Logistik sees all branches' drivers
            $getUsers = $users->pluck('id');
        } else {
            $getUsers   = $users->where('cabang_id', $targetCabangId)->pluck('id');
        }
        $userIdsStr = $getUsers->implode(',');

        // Buat kondisi filter ID user
        if ((in_array($role, [1, 9, 10]) && $cabangId && $userIdsStr) || $role === 8) {
            $idManagerExclude = "IN({$userIdsStr})";
        } elseif (in_array($role, [1, 9, 10]) && $cabangId && ! $userIdsStr) {
            $idManagerExclude = "";
        } else {
            $idManagerExclude = "NOT IN(1,13,36)";
        }

        // Default sales kosong
        $sales = [];

        // Jika ada user yang valid atau mode exclude
        if ((! empty($userIdsStr) && in_array($role, [1, 9, 10, 8])) || $idManagerExclude === "NOT IN(1,13,36)") {
            if (empty($idManagerExclude)) $idManagerExclude = "NOT IN(1,13,36)";
            $sales = DB::select("
            SELECT u.id, u.name, r.name as role
            FROM users u
            INNER JOIN model_has_roles mhr ON mhr.model_id = u.id
            INNER JOIN roles r ON mhr.role_id = r.id
            WHERE r.id IN ($roleList) AND u.id $idManagerExclude AND u.status = 1
        ");
        }

        // Inisialisasi data per bulan untuk setiap sales
        $monthlyData = [];

        if (! empty($sales)) {
            foreach ($sales as $sale) {
                $monthlyData[$sale->id] = [
                    'months' => [],
                    'yearly_avg' => 0,
                    'total_visits' => 0,
                    'total_work_days' => 0
                ];

                // Loop untuk 12 bulan
                for ($month = 1; $month <= 12; $month++) {
                    $startDate = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-01";
                    $endDate   = date("Y-m-t", strtotime($startDate));

                    // Ambil hari libur untuk bulan ini
                    $arrayDateOff = HariLibur::whereMonth('tanggal', $month)
                        ->whereYear('tanggal', $year)
                        ->pluck('tanggal')
                        ->toArray();

                    // Hitung hari kerja (Senin-Jumat, exclude libur)
                    $workDays = 0;
                    $currentDate = strtotime($startDate);
                    $endDateTimestamp = strtotime($endDate);

                    while ($currentDate <= $endDateTimestamp) {
                        $dayOfWeek = date('N', $currentDate); // 1 (Senin) - 7 (Minggu)
                        $dateStr = date('Y-m-d', $currentDate);

                        // Senin-Jumat (1-5) dan bukan hari libur
                        if ($dayOfWeek >= 1 && $dayOfWeek <= 5 && !in_array($dateStr, $arrayDateOff)) {
                            $workDays++;
                        }

                        $currentDate = strtotime('+1 day', $currentDate);
                    }

                    // Ambil data kunjungan untuk bulan ini
                    $result = DB::select("
                        SELECT
                            j.date AS date,
                            l.id AS laporan_id,
                            dj.activity_type,
                            a_in.created_at AS checkin_time,
                            a_out.created_at AS checkout_time,
                            (SELECT COUNT(*) FROM laporan_sales ls2 WHERE ls2.general_id = g.id AND ls2.user_id = l.user_id AND ls2.id < l.id) = 0 AS is_first_visit
                        FROM users u
                        INNER JOIN jadwals j ON j.user_id = u.id
                        INNER JOIN detail_jadwals dj ON j.id = dj.jadwal_id
                        INNER JOIN laporan_sales l ON l.jadwal_id = j.id AND l.general_id = dj.general_id
                        INNER JOIN general_informations g ON l.general_id = g.id AND dj.general_id = g.id
                        LEFT JOIN attendances a_in ON a_in.user_id = u.id AND a_in.general_id = g.id AND DATE(a_in.created_at) = j.date AND a_in.status = 'check in'
                        LEFT JOIN attendances a_out ON a_out.user_id = u.id AND a_out.general_id = g.id AND DATE(a_out.created_at) = j.date AND a_out.status = 'check out'
                        WHERE u.id = ? AND dj.deleted_at IS NULL AND j.date BETWEEN ? AND ?
                    ", [$sale->id, $startDate, $endDate]);

                    // Hitung productivity untuk bulan ini
                    $dailyProductivity = [];
                    foreach ($result as $visit) {
                        $date = $visit->date;

                        if (!isset($dailyProductivity[$date])) {
                            $dailyProductivity[$date] = 0;
                        }

                        // Hitung hanya visit yang valid
                        if (
                            $visit->activity_type === 'Visit' &&
                            !empty($visit->checkin_time) &&
                            !empty($visit->checkout_time)
                        ) {

                            $checkin = \Carbon\Carbon::parse($visit->checkin_time);
                            $checkout = \Carbon\Carbon::parse($visit->checkout_time);
                            $minutes = $checkin->diffInMinutes($checkout);
                            $isNewCust = (bool) $visit->is_first_visit;

                            // Valid visit: durasi >= 20 menit atau customer baru
                            if (($minutes >= 20 || $isNewCust) && $dailyProductivity[$date] < 3) {
                                $dailyProductivity[$date]++;
                            }
                        }
                    }

                    // Hitung percentage productivity per hari
                    $totalProductivity = 0;
                    $productiveDaysCount = 0;

                    foreach ($dailyProductivity as $date => $visitCount) {
                        $dayOfWeek = date('N', strtotime($date));

                        // Hanya hitung hari kerja (Senin-Jumat)
                        if ($dayOfWeek >= 1 && $dayOfWeek <= 5 && !in_array($date, $arrayDateOff)) {
                            $effectiveCount = min($visitCount, 3); // Max 3
                            $dailyPercentage = ($effectiveCount / 3) * 100;
                            $totalProductivity += $dailyPercentage;
                            $productiveDaysCount++;
                        }
                    }

                    // Monthly average productivity
                    $monthlyProductivity = 0;
                    if ($workDays > 0) {
                        // Jika ada hari yang dikunjungi, hitung rata-rata dari hari produktif
                        // Jika tidak ada kunjungan sama sekali, produktivitas = 0
                        if ($productiveDaysCount > 0) {
                            $monthlyProductivity = $totalProductivity / $productiveDaysCount;
                        } else {
                            $monthlyProductivity = 0;
                        }
                    }

                    $totalVisits = array_sum($dailyProductivity);

                    $monthlyData[$sale->id]['months'][$month] = [
                        'productivity' => round($monthlyProductivity, 1),
                        'total_visits' => $totalVisits,
                        'work_days' => $workDays,
                        'visited_days' => $productiveDaysCount
                    ];

                    $monthlyData[$sale->id]['total_visits'] += $totalVisits;
                    $monthlyData[$sale->id]['total_work_days'] += $workDays;
                }

                // Hitung yearly average
                $yearlyTotal = 0;
                $monthsWithData = 0;

                for ($month = 1; $month <= 12; $month++) {
                    if (isset($monthlyData[$sale->id]['months'][$month])) {
                        $yearlyTotal += $monthlyData[$sale->id]['months'][$month]['productivity'];
                        $monthsWithData++;
                    }
                }

                $monthlyData[$sale->id]['yearly_avg'] = $monthsWithData > 0
                    ? round($yearlyTotal / $monthsWithData, 1)
                    : 0;
            }
        }

        return view('back.dashboardreportyearly', compact(
            'year',
            'sales',
            'monthlyData',
            'cabangs',
            'role',
            'years'
        ));
    }
}
