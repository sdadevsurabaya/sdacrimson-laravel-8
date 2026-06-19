<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\User;
use App\Models\LaporanSales;
use App\Models\Attendance;
use App\Models\DetailJadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TrackingDeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $today = Carbon::today();

        // Tanggal bisa dipilih via filter, default hari ini
        $selectedDate = $request->date ? Carbon::parse($request->date) : $today;

        // Ambil semua jadwal Driver pada tanggal terpilih
        $driverIds = User::role('Driver')->pluck('id')->toArray();

        $jadwals = Jadwal::with([
                'user',
                'detailJadwals.generalInformation',
                'detailJadwals.attendances',
            ])
            ->whereIn('user_id', $driverIds)
            ->whereDate('date', $selectedDate)
            ->orderBy('date', 'desc')
            ->get();

        // Hitung ringkasan per driver
        $summaries = $jadwals->map(function ($jadwal) use ($selectedDate) {
            $details    = $jadwal->detailJadwals;
            $totalStop  = $details->count();

            // Laporan yang sudah dibuat untuk jadwal ini
            $laporans = LaporanSales::where('jadwal_id', $jadwal->id)->get();

            $totalLaporan  = $laporans->count();
            $totalOdoKm    = $laporans->whereNotNull('odo_km')->sum('odo_km');

            // Titik check-in dan check-out hari ini
            $checkIns  = Attendance::where('jadwal_id', $jadwal->id)
                ->where('status', 'check in')
                ->whereDate('created_at', $selectedDate)
                ->orderBy('created_at')
                ->get();
            $checkOuts = Attendance::where('jadwal_id', $jadwal->id)
                ->where('status', 'check out')
                ->whereDate('created_at', $selectedDate)
                ->orderBy('created_at')
                ->get();

            $firstCheckin  = $checkIns->first();
            $lastCheckout  = $checkOuts->last();

            // Status progres: selesai / on-going / belum mulai
            if ($totalLaporan === $totalStop && $totalStop > 0) {
                $statusLabel = 'Selesai';
                $statusClass = 'success';
            } elseif ($checkIns->count() > 0) {
                $statusLabel = 'Sedang Berjalan';
                $statusClass = 'warning';
            } else {
                $statusLabel = 'Belum Mulai';
                $statusClass = 'secondary';
            }

            // Detail per customer
            $customerDetails = $details->map(function ($detail) use ($jadwal, $selectedDate) {
                $laporan = LaporanSales::where('jadwal_id', $jadwal->id)
                    ->where('general_id', $detail->general_id)
                    ->first();

                $checkin = Attendance::where('jadwal_id', $jadwal->id)
                    ->where('general_id', $detail->general_id)
                    ->where('status', 'check in')
                    ->first();
                $checkout = Attendance::where('jadwal_id', $jadwal->id)
                    ->where('general_id', $detail->general_id)
                    ->where('status', 'check out')
                    ->first();

                return [
                    'detail'    => $detail,
                    'customer'  => $detail->generalInformation,
                    'laporan'   => $laporan,
                    'checkin'   => $checkin,
                    'checkout'  => $checkout,
                ];
            });

            return [
                'jadwal'          => $jadwal,
                'driver'          => $jadwal->user,
                'total_stop'      => $totalStop,
                'total_laporan'   => $totalLaporan,
                'total_odo_km'    => $totalOdoKm,
                'first_checkin'   => $firstCheckin,
                'last_checkout'   => $lastCheckout,
                'status_label'    => $statusLabel,
                'status_class'    => $statusClass,
                'customer_details'=> $customerDetails,
            ];
        });

        return view('delivery-tracking.index', compact('summaries', 'selectedDate'));
    }
}
