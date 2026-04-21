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
use App\Models\Jadwal;
use App\Models\DetailJadwal;
use App\Models\LaporanSales;

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
        $totalPlan   = 0;
        $totalAktual = 0;
        $persenVisit = 0;

        if ($user->hasRole('Sales') || $user->hasRole('Driver') || $user->hasRole('Collector')) {
            $bulanIni = now()->format('Y-m');

            // Total plan = jumlah baris detail jadwal milik user di bulan ini
            $totalPlan = DetailJadwal::whereHas('jadwal', function ($q) use ($id_user, $bulanIni) {
                $q->where('user_id', $id_user)
                  ->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$bulanIni])
                  ->whereNull('deleted_at');
            })->whereNull('deleted_at')->count();

            // Total aktual = jumlah laporan sales yang sudah dibuat user di bulan ini
            $totalAktual = LaporanSales::where('user_id', $id_user)
                ->whereHas('jadwal', function ($q) use ($bulanIni) {
                    $q->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$bulanIni]);
                })
                ->count();

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
