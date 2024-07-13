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
       
        $users = User::pluck('name', 'id');
        return view('reportsales.laporan-periode', compact('users'));
    }

    public function laporanPeriode(Request $request)
    {
        $startDate = $request->start; // contoh tanggal mulai
        $endDate = $request->end; // contoh tanggal akhir

        if($request->user == 'all'){
            $laporan = LaporanSales::with(['general', 'user', 'detailJadwal'])
            ->whereBetween('created_at', [$startDate, $endDate])
                ->get();
        }else{
            $laporan = LaporanSales::with(['general', 'user', 'detailJadwal'])
            ->where('user_id', $request->user)
            ->whereBetween('created_at', [$startDate, $endDate])
                ->get();
        }
      
    
      
        $userJadwal = Jadwal::with(['user'])->whereBetween('date', [$startDate, $endDate])->get();
    
     
        foreach ($laporan as $laporanItem) {
            $filteredDetailJadwal = $laporanItem->detailJadwal->where('jadwal_id', $laporanItem->jadwal_id)
                ->where('general_id', $laporanItem->general_id)
                ->first(); 
    
            $laporanItem->filteredDetailJadwal = $filteredDetailJadwal;
        }
    
        // dd($laporan);

        return view('reportsales.print-laporan-periode', compact('laporan', 'userJadwal'));
    }
    
}
