<?php

namespace App\Http\Controllers\DetailJadwal;

use App\Models\Jadwal;
use App\Models\Attendance;
use App\Models\DetailJadwal;
use Illuminate\Http\Request;
use App\Models\General_model;
use App\Http\Controllers\Controller;

class DetailJadwalController extends Controller
{
    public function index(Request $request, $id)
    {

        $general = General_model::pluck('nama_usaha', 'id');
        $jadwal_id = $id;

        $jadwal = Jadwal::find($id);
        return view('jadwal.addJadwal', compact('general', 'jadwal_id', 'jadwal'));
    }


    public function getDataById(Request $request)
    {
        $id = $request->get('id');

        $data = DetailJadwal::with(['customer', 'laporanSales' => function ($query) use ($id) {
            $query->where('jadwal_id', $id);
        }])->where('jadwal_id', $id)->get();

        // Ambil semua record attendance check-in untuk jadwal ini
        $checkins = Attendance::where('jadwal_id', $id)
            ->where('status', 'check in')
            ->get()
            ->keyBy('general_id');

        // Tambahkan jam checkin ke setiap item
        $data->transform(function ($item) use ($checkins) {
            $attendance = $checkins->get($item->general_id);
            $item->checkin_actual = $attendance ? $attendance->created_at->format('H:i') : null;
            return $item;
        });

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

    public function getCustomer($id)
    {
        $customer = \App\Models\General_model::select('id', 'nama_usaha', 'alamat_kantor')
            ->find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer tidak ditemukan'], 404);
        }

        return response()->json([
            'id' => $customer->id,
            'nama_usaha' => $customer->nama_usaha,
            'alamat' => $customer->alamat_kantor, // ubah key agar cocok dengan JS
        ]);
    }
}
