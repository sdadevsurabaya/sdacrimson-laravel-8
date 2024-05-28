<?php

namespace App\Http\Controllers;

use App\Models\LaporanFoto;
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
        try {
        // dd($request->hasFile('member_image'));
       // Validasi input untuk data laporan
       $validatedLaporan = $request->validate([
        'laporan' => 'required|string',
        'user_id' => 'required|string',
        'general_id' => 'required|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
    ]);


    $laporanSales = new LaporanSales();
    $laporanSales->general_id = $validatedLaporan['general_id'];
    $laporanSales->user_id = $validatedLaporan['user_id'];
    $laporanSales->pesan = $validatedLaporan['laporan'];
    $laporanSales->latitude = $validatedLaporan['latitude'];
    $laporanSales->longitude = $validatedLaporan['longitude'];
    $laporanSales->save();

 
    $validatedFoto = $request->validate([
        'member_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
        'namafoto.*' => 'nullable|string',
    ]);

   

    if ($request->hasFile('member_image')) {
        foreach ($request->file('member_image') as $key => $file) {
        
            $now = Carbon::now();
            $formattedDate = $now->format('Ymd_');
            $name = $formattedDate . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $path = public_path('laporan/' . $name);
            Image::make($file)->resize(750, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

          
            $laporanFoto = new LaporanFoto();
            $laporanFoto->laporan_sales_id = $laporanSales->id; 
            $laporanFoto->foto = $name;
            $laporanFoto->nama = $validatedFoto['namafoto'][$key] ?? ''; 
            $laporanFoto->save();
        }
    }

    return redirect('/kunjungan' )->with('success', 'Data berhasil disimpan');
} catch (\Illuminate\Validation\ValidationException $e) {
    return redirect()->back()->withErrors($e->validator->errors())->withInput();
} catch (\Exception $e) {
    return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
}
    // return response()->json(['success' => 'Data berhasil disimpan']);
    }
}
