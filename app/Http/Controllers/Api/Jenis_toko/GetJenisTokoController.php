<?php

namespace App\Http\Controllers\Api\Jenis_toko;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GetJenisTokoController extends Controller
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

    public function index(Request $request)
    {
        $jenis_toko = [];
        $response =  DB::select('select * from jenis_toko order by kode');
        for ($m = 0; $m < count($response); $m++) {
            $res = $response[$m];
            array_push($jenis_toko, $res);
        }
        return $jenis_toko;
    }
}