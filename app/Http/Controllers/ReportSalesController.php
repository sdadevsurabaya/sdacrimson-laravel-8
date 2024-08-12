<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\User;
use App\Models\Jarak;
use App\Models\Jadwal;
use App\Models\Report;
use Illuminate\Support\Str;
use App\Models\LaporanSales;
use App\Models\LocationTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ReportSalesController extends Controller
{
    public function index(Request $request){

        $startDate = $request->start;
        $endDate = $request->end;

        $users = User::pluck('name', 'id');

        $hasRole = auth()->user()->hasRole('Sales');

        if( $hasRole){

            if( $startDate &&   $endDate){
                $jadwals = Jadwal::where('user_id', Auth::id())->orderBy('created_at','desc')->whereBetween('date', [$startDate, $endDate])->withTrashed()->whereNull('deleted_at')->get();
            }else{
                $jadwals = Jadwal::where('user_id', Auth::id())->orderBy('created_at','desc')->withTrashed()->whereNull('deleted_at')->get();
            }

        }else {
            if( $startDate &&   $endDate){
                $jadwals = Jadwal::orderBy('created_at', 'desc')
                ->withTrashed()
                ->whereNull('deleted_at')
                ->whereBetween('date', [$startDate, $endDate])
                ->get();
            }else{
                $jadwals = Jadwal::orderBy('created_at', 'desc')
                ->withTrashed()
                ->whereNull('deleted_at')
                ->get();
            }


        }
        return view('reportsales.index', compact('users', 'jadwals'));
    }

    public function exportrekapvisit(){
        $users = User::pluck('name', 'id');
        return view('reportsales.rekapvisit', compact('users'));
    }

    public function previewrekapvisit($id)
    {

        $laporan = LaporanSales::with(['general', 'user', 'detailJadwal'])
            ->where('jadwal_id', $id)
            ->get();


        $userJadwal = Jadwal::with(['user'])->find($id);


        foreach ($laporan as $laporanItem) {
            $filteredDetailJadwal = $laporanItem->detailJadwal->where('jadwal_id', $laporanItem->jadwal_id)
                ->where('general_id', $laporanItem->general_id)
                ->first();

            $laporanItem->filteredDetailJadwal = $filteredDetailJadwal;
        }

        // dd($laporan);

        return view('reportsales.rekapPreview', compact('laporan', 'userJadwal'));
    }

    public function previewrekapAbsen($id)
    {
        $laporan = LaporanSales::with(['general', 'user', 'detailJadwal', 'jarak', 'attendance' => function($query) use($id) {
            $query->orderBy('id', 'asc');
            $query->where('jadwal_id', $id);
        }])
        ->where('jadwal_id', $id)
        ->get()
        ->sortBy(function($laporan) {
            $attendance = $laporan->attendance->first();
            return $attendance ? $attendance->id : null; 
        });
       
        $userJadwal = Jadwal::with(['user'])->find($id);

        $user_id = $laporan[0]->user_id ?? 0;

        $getJarak= Jarak::where('user_id', $user_id)->where('jadwal_id', $id)->orderBy('id', 'desc')->first();
     
        // dd($laporan[0]->created_at);

        $createdAt = $laporan[0]->created_at ?? now();
     

        $stop = LocationTime::where('user_id', $user_id)
            ->whereDate('created_at', $createdAt)
            ->where('type', 'stop')
            ->orderBy('id', 'desc')
            ->first();
        

        // dd($stop);
        
        if($stop){
            $newLaporan = new LaporanSales([
            'jadwal_id' => $id,
            'user_id' => Auth::id(),
            'created_at' =>$laporan[0]->created_at,
            'general_id' => $getJarak->general_id,
         
        ]);

    

     
        if ($getJarak) {
            $newLaporan->setRelation('jarak', collect([$getJarak]));
        }

      
      
        
      
            $laporan->push($newLaporan);

            //  dd($laporan);
      
        }
     

       
       

        return view('reportsales.rekapAbsen', compact('laporan', 'userJadwal'));
    }




}
