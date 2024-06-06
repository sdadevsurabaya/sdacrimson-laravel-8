<?php

namespace App\Http\Controllers;

use Auth;

use Validator;
use App\Models\Attendance;
use App\Models\Legal_model;
use App\Models\DetailJadwal;
use App\Models\DrafId_model;
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

        $userId = auth()->user()->id; // atau sesuaikan dengan metode mendapatkan user_id

        // $generalInformations = General_model::whereHas('jadwal', function ($query) use ($userId, $today) {
        //     $query->where('user_id', $userId)
        //           ->whereDate('date', $today);
        // })->get();

        $data = General_model::whereHas('jadwals', function ($query) use ($userId, $today) {
            $query->where('user_id', $userId)
            ->whereDate('date', '<=', $today);
        })->with(['jadwals' => function ($query) {
            $query->select('jadwals.*');
        }, 'jadwals.user' => function ($query) {
            $query->select('id', 'name');
        }])->get();



        // dd($data);

        return view('kunjungan.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function laporan($id){
        // dd($id);
        $general = General_model::find($id);

        $checkin = Attendance::where('general_id', $id)
        ->where('status', 'check in')
        ->whereDate('created_at', now()->toDateString())
        ->first();

        $checkout = Attendance::where('general_id', $id)
                    ->where('status', 'check out')
                    ->whereDate('created_at', now()->toDateString())
                    ->first();
        return view('kunjungan.laporan', compact('general', 'checkin', 'checkout'));
    }

}
