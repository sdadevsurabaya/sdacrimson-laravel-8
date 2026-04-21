<?php
/**
 * author : Suryo Atmojo <suryoatm@gmail.com>
 * project : Supresso Laravel
 * Start-date : 19-09-2022
 */

namespace App\Http\Controllers;

use App\Models\General_model;
use App\Models\Legal_model;
use App\Models\ContactPerson_model;
use App\Models\LocationTime;
use App\Models\Outlet_model;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $id_user = Auth::user()->id;
        $user    = Auth::user();

        // Data outlet summary (dipakai untuk non-sales roles)
        if ($user->hasRole('Sales')) {
            $get_general = General_model::where('ar', $id_user)->get();
            $get_legal   = Legal_model::where('ar', $id_user)->get();
            $get_kontak  = ContactPerson_model::where('ar', $id_user)->get();
            $get_outlet  = Outlet_model::where('ar', $id_user)->get();
        } else {
            $get_general = General_model::all();
            $get_legal   = Legal_model::all();
            $get_kontak  = ContactPerson_model::all();
            $get_outlet  = Outlet_model::all();
        }

        // Data kunjungan bulan ini untuk Sales, Driver, Collector
        // Menggunakan logika yang sama dengan MonthlyReportController::getMonthlyStats
        $totalPlan   = 0;
        $totalAktual = 0;
        $persenVisit = 0;

        if ($user->hasRole('Sales') || $user->hasRole('Driver') || $user->hasRole('Collector')) {
            $startDate = now()->startOfMonth()->format('Y-m-d');
            $endDate   = now()->endOfMonth()->format('Y-m-d');

            // Target tetap: 20 hari kerja × 4 kunjungan/hari = 80 (sama dengan MonthlyReport)
            $totalPlan = 80;

            // Aktual: kunjungan Visit yang ada check-in + check-out,
            // durasi >= 20 menit, dibatasi max 4 per hari (identik dengan MonthlyReportController)
            $visits = DB::select("
                SELECT DATE(j.date) as visit_date, COUNT(*) as visit_count
                FROM jadwals j
                INNER JOIN detail_jadwals dj ON j.id = dj.jadwal_id
                INNER JOIN laporan_sales l ON l.jadwal_id = j.id
                INNER JOIN general_informations g ON l.general_id = g.id AND dj.general_id = g.id
                INNER JOIN attendances a_in  ON a_in.user_id  = j.user_id AND a_in.general_id  = g.id AND DATE(a_in.created_at)  = j.date AND a_in.status  = 'check in'
                INNER JOIN attendances a_out ON a_out.user_id = j.user_id AND a_out.general_id = g.id AND DATE(a_out.created_at) = j.date AND a_out.status = 'check out'
                WHERE j.user_id = ?
                AND dj.deleted_at IS NULL
                AND dj.activity_type = 'Visit'
                AND j.date BETWEEN ? AND ?
                AND TIMESTAMPDIFF(MINUTE, a_in.created_at, a_out.created_at) >= 20
                GROUP BY DATE(j.date)
            ", [$id_user, $startDate, $endDate]);

            foreach ($visits as $v) {
                $totalAktual += min($v->visit_count, 4);
            }

            $persenVisit = $totalPlan > 0
                ? round(($totalAktual / $totalPlan) * 100, 1)
                : 0;
        }

        $start = LocationTime::where('user_id', Auth::id())->whereDate('created_at', now())
            ->where('type', 'start')
            ->orderBy('id', 'desc')
            ->first();

        $stop = LocationTime::where('user_id', Auth::id())->whereDate('created_at', now())
            ->where('type', 'stop')
            ->orderBy('id', 'desc')
            ->first();

        return view('dashboard.index', compact(
            'get_general', 'get_legal', 'get_kontak', 'get_outlet',
            'start', 'stop',
            'totalPlan', 'totalAktual', 'persenVisit'
        ));
    }


}
