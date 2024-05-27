<?php

namespace App\Http\Controllers;

use Auth;

use Validator;
use App\Models\Attendance;
use App\Models\Legal_model;
use App\Models\DrafId_model;
use App\Models\Outlet_model;
use Illuminate\Http\Request;
use App\Exports\OutletExport;
use App\Models\Account_model;
use App\Models\General_model;
use App\Exports\GeneralExport;

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
        if (Auth::user()->hasRole("Admin") == 1 || Auth::user()->hasRole("Verifikator") == 1) {
            $data = General_model::join("users", "users.id", "=", "general_informations.ar")
                ->orderBy('general_informations.id', 'desc')
                ->get(['*', 'general_informations.id as id_general']);
        } else {
            $data = General_model::join("users", "users.id", "=", "general_informations.ar")
                ->where('ar', Auth::user()->id)
                ->orderBy('general_informations.id', 'desc')
                ->get(['*', 'general_informations.id as id_general']);
        }

        $getId = General_model::orderBy('id', 'desc')->get();
        // $id_customer = $getId[1]->id_customer;

        // return view('general.index',compact('data', 'id_customer'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
        return view('kunjungan.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function laporan(Request $request){
        return view('kunjungan.laporan');
    }

}
