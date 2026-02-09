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
            'general_id' => 'required',
            'plant_date' => 'nullable',
            'note' => 'required',
            'activity_type' => 'required',
            'jadwal_id' => 'required',
        ]);

        // Validasi: Cek apakah user masih ada jadwal yang belum checkout untuk customer yang sama
        $userId = Auth::id();
        $generalId = $request->general_id;
        
        // Cari jadwal yang dibuat oleh user yang sama hari ini
        $existingSchedule = DetailJadwal::whereHas('jadwal', function($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->whereDate('date', now()->toDateString());
            })
            ->where('general_id', $generalId)
            ->whereNotNull('checkin')  // Sudah check-in
            ->whereNull('checkout')     // Belum checkout
            ->first();

        if ($existingSchedule) {
            return redirect()
                ->back()
                ->with('error', 'Anda masih memiliki jadwal yang belum di-checkout untuk customer ini. Silakan checkout terlebih dahulu sebelum membuat jadwal baru.');
        }

        // Simpan data ke dalam database
        DetailJadwal::create([
            'general_id' => $request->general_id,
            'plant_date' => $request->plant_date,
            'note' => $request->note,
            'jadwal_id' => $request->jadwal_id,
            'activity_type' => $request->activity_type,
            'status' => 'Pending',
            'created_by_id' => Auth::id(),
        ]);

        // Redirect atau berikan respons sesuai kebutuhan Anda
        return redirect()->route('jadwal.createJadwal')->with('success', 'Jadwal berhasil ditambahkan');
    }
}
