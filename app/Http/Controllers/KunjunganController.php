<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\Attendance;
use App\Models\Legal_model;
use App\Models\DetailJadwal;
use App\Models\DrafId_model;
use App\Models\LaporanSales;
use App\Models\Outlet_model;
use Illuminate\Http\Request;
use App\Exports\OutletExport;
use App\Models\Account_model;
use App\Models\General_model;

use App\Exports\GeneralExport;
use Illuminate\Support\Carbon;
use App\Models\Attachment_model;
use App\Models\StatusData_model;

use App\Models\Distributor_model;
use Illuminate\Support\Facades\DB;
use App\Models\ContactPerson_model;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DetailDistributor_model;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KunjunganController extends Controller
{
    public function index(Request $request)
    {
        // if (Auth::user()->hasRole("Admin") == 1 || Auth::user()->hasRole("Verifikator") == 1) {
        //     $data = General_model::join("users", "users.id", "=", "general_informations.ar")
        //         ->orderBy('general_informations.id', 'desc')
        //         ->get(['*', 'general_informations.id as id_general']);
        // } else {
        //     $data = General_model::join("users", "users.id", "=", "general_informations.ar")
        //         ->where('ar', Auth::user()->id)
        //         ->orderBy('general_informations.id', 'desc')
        //         ->get(['*', 'general_informations.id as id_general']);
        // }
        $today = Carbon::today();
        $tenDaysAgo = Carbon::today()->subDays(10);

        $user = auth()->user();
        $isLogistik = $user->hasRole('Logistik');
        $userId = $user->id; // default if not Logistik
        
        // If Logistik, we want all schedules belonging to the "Driver" role
        $driverIds = [];
        if ($isLogistik) {
            $driverIds = \App\Models\User::role('Driver')->pluck('id')->toArray();
        }

        $data = General_model::whereHas('jadwals', function ($query) use ($userId, $today, $tenDaysAgo, $isLogistik, $driverIds) {
            if ($isLogistik) {
                $query->whereIn('user_id', $driverIds);
            } else {
                $query->where('user_id', $userId);
            }
            $query->whereDate('date', '<=', $today)
                  ->whereDate('date', '>=', $tenDaysAgo);
        })->with([
            'jadwals' => function ($query) use ($userId, $today, $tenDaysAgo, $isLogistik, $driverIds) {
                if ($isLogistik) {
                    $query->whereIn('user_id', $driverIds);
                } else {
                    $query->where('user_id', $userId);
                }
                $query->whereDate('date', '<=', $today)
                      ->whereDate('date', '>=', $tenDaysAgo)
                      ->select('jadwals.*');
            },
            'jadwals.user' => function ($query) {
                $query->select('id', 'name');
            },
            'laporanSales' => function ($query) {
                $query->select('laporan_sales.*');
            },
            'detailJadwals' => function ($query) use ($userId, $isLogistik, $driverIds) {
                $query->select('detail_jadwals.*')
                      ->whereHas('jadwal', function ($query) use ($userId, $isLogistik, $driverIds) {
                          if ($isLogistik) {
                              $query->whereIn('user_id', $driverIds);
                          } else {
                              $query->where('user_id', $userId);
                          }
                      });
            }
        ])->get();
        
    
        $formattedData = $data->flatMap(function ($item) {
            return $item->jadwals->map(function ($jadwal) use ($item) {
                $detailJadwal = $jadwal->detailJadwals->where('general_id', $item->id)->first();
                
                return [
                    'general' => $item,
                    'jadwal' => $jadwal,
                    'activityType' => $detailJadwal ? $detailJadwal['activity_type'] : null,
                ];
            });
        });
        
        // Urutkan $formattedData berdasarkan jadwal date secara descending
        $formattedData = $formattedData->sortByDesc(function ($item) {
            return $item['jadwal']->date;
        })->values();
        
        
      
        return view('kunjungan.index', compact('formattedData'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function laporan($id, $jadwal){
     
        $queryLaporan = LaporanSales::with(['gambar'])->where('general_id', $id)->where('jadwal_id', $jadwal);
        
        if (!Auth::user()->hasRole('Logistik')) {
            $queryLaporan->where('user_id', Auth::id());
        }
        
        $laporan = $queryLaporan->first();
        $detailJadwal = DetailJadwal::where('general_id', $id)->where('jadwal_id', $jadwal)->first();
        $general = General_model::find($id);
      
        $checkin = Attendance::where('general_id', $id)
        ->where('status', 'check in')
        ->where('jadwal_id', $jadwal)
        ->first();

        $checkout = Attendance::where('general_id', $id)
                    ->where('status', 'check out')
                    ->where('jadwal_id', $jadwal)
                    ->first();

        $Contact = LaporanSales::where('general_id', $id)->orderBy('id', 'DESC')->first();
        // dd($Contact);
        return view('kunjungan.laporan', compact('general', 'checkin', 'checkout', 'laporan', 'detailJadwal', 'Contact'));
    }

}
