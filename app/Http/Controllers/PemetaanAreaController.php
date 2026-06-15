<?php

namespace App\Http\Controllers;

use App\Models\General_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemetaanAreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Get unique kota and area for filter options
        $kotas = General_model::select('kota')->whereNotNull('kota')->where('kota', '!=', '')->groupBy('kota')->get();
        $areas = General_model::select('area')->whereNotNull('area')->where('area', '!=', '')->groupBy('area')->get();

        $query = General_model::select('id', 'id_customer', 'nama_usaha', 'nama_lengkap', 'alamat_kantor', 'kota', 'area', 'latitude', 'longitude', 'status');

        if ($request->has('kota') && $request->kota != '') {
            $query->where('kota', $request->kota);
        }

        if ($request->has('area') && $request->area != '') {
            $query->where('area', $request->area);
        }

        $customers = $query->get();

        return view('pemetaan-area.index', compact('kotas', 'areas', 'customers'));
    }
}
