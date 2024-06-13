<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Models\General_model;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'nama_customer' => 'required|string|max:255',
        ]);

        $covert_huruf_besar = strtoupper($request->nama_customer);
        $huruf = substr($covert_huruf_besar, 0, 3);
        
        $latest_general = General_model::orderBy('id', 'desc')->first();
        if ($latest_general) {
            $urutan = intval(substr($latest_general->id_customer, strrpos($latest_general->id_customer, '-') + 1));
            $urutan++; // Tambahkan satu ke nomor urutan
        } else {
            $urutan = 0;
        }
        
        $id_customer = $huruf . "-" . sprintf("%03d", $urutan);

      

        // Buat instance model General_model
        $lead = new General_model();

        // Set nilai-nilai untuk model
        $lead->nama_usaha = $covert_huruf_besar;
        $lead->id_customer = $id_customer; // Gunakan strtoupper untuk memastikan huruf kapital
        $lead->status = 'Lead'; // Gunakan strtoupper untuk memastikan huruf kapital
        $lead->save();

        // Kirim respons ke JavaScript (opsional)
        return response()->json(['message' => 'Lead berhasil ditambahkan']);
    }
}
