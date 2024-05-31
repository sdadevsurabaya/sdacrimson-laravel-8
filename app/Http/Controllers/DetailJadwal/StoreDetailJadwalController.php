<?php

namespace App\Http\Controllers\DetailJadwal;

use App\Models\DetailJadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StoreDetailJadwalController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'general_id' => 'required', // Sesuaikan dengan aturan validasi yang Anda butuhkan
            'plant_date' => 'required',
            'note' => 'required',
            'general_id' => 'required',
            'activity_type' => 'required',
            'jadwal_id' => 'required',
        ]);

        // Simpan data ke dalam database
        DetailJadwal::create([
            'general_id' => $request->general_id,
            'plant_date' => $request->plant_date,
            'note' => $request->note,
            'general_id' => $request->general_id,
            'jadwal_id' => $request->jadwal_id,
            'activity_type' => $request->activity_type,
            'status' => 'Pending',
            'created_by_id' => Auth::id(),
        ]);

        // Redirect atau berikan respons sesuai kebutuhan Anda
        return redirect()->route('jadwal.createJadwal'); // Gantikan 'route.name' dengan nama route yang sesuai
    }
}
