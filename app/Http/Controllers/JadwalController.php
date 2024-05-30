<?php

namespace App\Http\Controllers;

use Auth;

use Validator;
use App\Models\Attendance;

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

class JadwalController extends Controller
{
    public function index(){
        return view('jadwal.index');
    }

    public function create(){
        // dd($id);
        return view('jadwal.createJadwal');
    }

    public function add(){
        // dd($id);
        return view('jadwal.addJadwal');
    }

}
