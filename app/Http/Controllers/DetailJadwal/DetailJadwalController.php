<?php

namespace App\Http\Controllers\DetailJadwal;

use App\Models\Jadwal;
use App\Models\DetailJadwal;
use Illuminate\Http\Request;
use App\Models\General_model;
use App\Http\Controllers\Controller;

class DetailJadwalController extends Controller
{
    public function index(Request $request, $id){
       
        $general = General_model::pluck('nama_usaha', 'id');
       $jadwal_id = $id;

       $jadwal = Jadwal::find($id);
        return view('jadwal.addJadwal', compact('general', 'jadwal_id', 'jadwal'));
    }

    
    public function getDataById(Request $request)
    {
        $id = $request->get('id');
        // Ambil data berdasarkan ID
        $data = DetailJadwal::with(['customer'])->where('jadwal_id', $id)->get();

        return response()->json($data);
    }

    public function destroy($id)
    {
        
        $jadwal = DetailJadwal::find($id);

        if ($jadwal) {
            $jadwal->delete(); // Ini akan melakukan soft delete jika model Anda menggunakan soft deletes
            return response()->json(['success' => true, 'message' => 'Detail Jadwal berhasil dibatalkan']);
        } else {
            return response()->json(['success' => false, 'message' => 'Detail Jadwal tidak ditemukan']);
        }
    }


    

}
