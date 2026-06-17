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
        // Get unique kota and area for filter options from master table (areas)
        $kotas = \App\Models\AreaCustomer::select('kota')->whereNotNull('kota')->where('kota', '!=', '')->groupBy('kota')->get();
        $areas = \App\Models\AreaCustomer::select('nama_area as area', 'kota')->whereNotNull('nama_area')->where('nama_area', '!=', '')->groupBy('nama_area', 'kota')->get();

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'kota' => 'required',
            'area' => 'required',
        ]);

        $customer = General_model::findOrFail($id);
        $customer->kota = $request->kota;
        $customer->area = $request->area;
        $customer->save();

        return redirect()->route('pemetaan.area.index')->with('success', 'Data Kota dan Area berhasil diperbarui.');
    }
}
