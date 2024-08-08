<?php

namespace App\Http\Controllers\DetailJadwal;

use App\Http\Controllers\Controller;
use App\Models\DetailJadwal;
use Illuminate\Http\Request;

class GetDetailJadwalController extends Controller
{
    public function index()

    {
        $Jadwal = DetailJadwal::with('customer')->whereDate('created_at', now())->get();
        $customerDetails = $Jadwal->pluck('customer.nama_usaha', 'customer.id')->toArray();
        $newCustomer = [470 => 'Toko SDA Global'];

        // Menggabungkan data baru dengan data yang diambil dari database
        $combinedDetails = $newCustomer + $customerDetails;

        return response()->json($combinedDetails);
    }
}
