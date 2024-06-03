<?php

namespace App\Http\Controllers\DetailJadwal;

use App\Models\Jadwal;
use App\Models\DetailJadwal;
use Illuminate\Http\Request;
use App\Models\General_model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EditDetailJadwalController extends Controller
{
    public function index(Request $request, $id){
       
        $DetailJadwal = DetailJadwal::find($id);
        $general = General_model::pluck('nama_usaha', 'id');
       $jadwal_id = $DetailJadwal->jadwal_id;

       $jadwal = Jadwal::find($DetailJadwal->jadwal_id);
        return view('jadwal.editDetailJadwal', compact('general', 'jadwal_id', 'jadwal', 'DetailJadwal'));
    }

    public function store(Request $request)
    {
        
        // Validasi input
        $validated = $request->validate([
            'jadwal_id' => 'required|integer',
            'status_jadwal' => 'required|string',
            'actual_date' => 'required|date_format:H:i',
            'note' => 'required|string',
        ]);

     


        // Cari detail jadwal berdasarkan jadwal_id
        $detailJadwal = DetailJadwal::find($validated['jadwal_id']);

              // Cek apakah checkin null
              if (is_null($detailJadwal->checkin)) {
                return redirect()->back()->withErrors(['checkin' => 'Anda belum melakukan checkin.']);
            }
    
            // Cek apakah checkin ada tetapi checkout null
            if (!is_null($detailJadwal->checkin) && is_null($detailJadwal->checkout)) {
                return redirect()->back()->withErrors(['checkout' => 'Anda belum melakukan checkout.']);
            }

        // dd($validated['status_jadwal']);
        // Update data
        $detailJadwal->status = $validated['status_jadwal'];
        $detailJadwal->actual_date = $validated['actual_date'];
        $detailJadwal->note = $validated['note'];
        $detailJadwal->modified_by_id = Auth::id();

        // Simpan perubahan
        $detailJadwal->save();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Detail jadwal berhasil diperbarui.');
    }

}
