<?php

namespace App\Http\Controllers\Laporan;

use App\Models\User;
use App\Models\Jadwal;
use App\Models\LaporanSales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanPeriodeController extends Controller
{

    public function index()
    {

        $user = auth()->user();
        
        if ($user->hasRole('Logistik')) {
            $users = User::role('Driver')->pluck('name', 'id');
        } else {
            $users = User::pluck('name', 'id');
        }

        return view('reportsales.laporan-periode', compact('users'));
    }

    // public function laporanPeriode(Request $request)
    // {
    //     $startDate = $request->start; // contoh tanggal mulai
    //     $endDate = $request->end; // contoh tanggal akhir

    //     if ($request->user == 'all') {
    //         $laporan = LaporanSales::with(['general', 'user', 'detailJadwal'])
    //             ->whereBetween('created_at', [$startDate, $endDate])
    //             ->get();
    //     } else {
    //         $laporan = LaporanSales::with(['general', 'user', 'detailJadwal'])
    //             ->where('user_id', $request->user)
    //             ->whereBetween('created_at', [$startDate, $endDate])
    //             ->get();
    //     }



    //     $userJadwal = Jadwal::with(['user'])->whereBetween('date', [$startDate, $endDate])->get();


    //     foreach ($laporan as $laporanItem) {
    //         $filteredDetailJadwal = $laporanItem->detailJadwal->where('jadwal_id', $laporanItem->jadwal_id)
    //             ->where('general_id', $laporanItem->general_id)
    //             ->first();

    //         $laporanItem->filteredDetailJadwal = $filteredDetailJadwal;
    //     }

    //     // dd($laporan);

    //     return view('reportsales.print-laporan-periode', compact('laporan', 'userJadwal'));
    // }

    public function laporanPeriode(Request $request)
    {
        $startDate = $request->start;
        $endDate = $request->end;

        $laporan = LaporanSales::with(['general', 'user', 'detailJadwal', 'jadwal'])
            ->join('jadwals', 'laporan_sales.jadwal_id', '=', 'jadwals.id')
            ->whereBetween('jadwals.date', [$startDate, $endDate])
            ->select(
                'laporan_sales.*',
                'jadwals.date as tanggal_jadwal' // ambil tanggal jadwal untuk urutan & tampilan
            )
            ->orderBy('jadwals.date', 'asc')
            ->orderBy('laporan_sales.id', 'asc'); // tambahan biar urutan stabil

        if ($request->user != 'all') {
            $laporan->where('laporan_sales.user_id', $request->user);
        }

        $laporan = $laporan->get();

        // Ambil jadwal yang sesuai periode
        $userJadwal = Jadwal::with('user')
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();

        // Filter detailJadwal sesuai relasi jadwal & general
        foreach ($laporan as $laporanItem) {
            $filteredDetailJadwal = $laporanItem->detailJadwal
                ->where('jadwal_id', $laporanItem->jadwal_id)
                ->where('general_id', $laporanItem->general_id)
                ->first();

            $laporanItem->filteredDetailJadwal = $filteredDetailJadwal;
        }

        return view('reportsales.print-laporan-periode', compact('laporan', 'userJadwal'));
    }
}
