<?php

namespace App\Http\Controllers\DetailJadwal;

use App\Http\Controllers\Controller;
use App\Models\DetailJadwal;
use Illuminate\Http\Request;

class GetDetailJadwalController extends Controller
{
    public function index()

    {
        $Jadwal = DetailJadwal::with('customer')
            ->whereHas('jadwal', function ($query) {
                $query->whereDate('date', now())
                      ->where('user_id', auth()->id());
            })
            ->get();
        $customerDetails = $Jadwal->pluck('customer.nama_usaha', 'customer.id')->toArray();
        $userCabang = trim(strtolower(auth()->user()->cabang->cabang ?? ''));
        
        if ($userCabang == 'surabaya') {
            $officeName = 'SDA Surabaya';
        } elseif ($userCabang == 'jakarta') {
            $officeName = 'SDA Jakarta';
        } elseif ($userCabang == 'semarang') {
            $officeName = 'SDA Semarang';
        } elseif ($userCabang == 'balikpapan') {
            $officeName = 'SDA Balikpapan';
        } else {
            $officeName = auth()->user()->hasRole('Driver') ? 'SDA MARGOMULYO' : 'SDA GLOBAL INDONESIA';
        }

        $newCustomer = [553 => $officeName];

        // Menggabungkan data baru dengan data yang diambil dari database
        $combinedDetails = $newCustomer + $customerDetails;

        return response()->json($combinedDetails);
    }
}
