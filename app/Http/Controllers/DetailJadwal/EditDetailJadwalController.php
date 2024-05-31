<?php

namespace App\Http\Controllers\DetailJadwal;

use App\Models\Jadwal;
use App\Models\DetailJadwal;
use Illuminate\Http\Request;
use App\Models\General_model;
use App\Http\Controllers\Controller;

class EditDetailJadwalController extends Controller
{
    public function index(Request $request, $id){
       
        $DetailJadwal = DetailJadwal::find($id);
        $general = General_model::pluck('nama_usaha', 'id');
       $jadwal_id = $DetailJadwal->jadwal_id;

       $jadwal = Jadwal::find($DetailJadwal->jadwal_id);
        return view('jadwal.editDetailJadwal', compact('general', 'jadwal_id', 'jadwal', 'DetailJadwal'));
    }

}
