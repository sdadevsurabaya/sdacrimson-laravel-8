<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\LaporanSales;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class LaporanSalesController extends Controller
{
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'pesan' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'status' => 'required|string'
        ]);


        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            $now = Carbon::now();
            $formattedDate = $now->format('Ymd_');
            $name = $formattedDate . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $path = public_path('laporan/' . $name);
            Image::make($file)->resize(750, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
        }
        // Simpan data
        $laporan = new LaporanSales();
        $laporan->pesan = $request->input('pesan');
        $laporan->foto = $request->input('foto');
        $laporan->status = $request->input('status');
        $laporan->save();

        return response()->json(['message' => 'Data berhasil disimpan'], 201);
    }
}
