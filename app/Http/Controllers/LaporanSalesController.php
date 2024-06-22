<?php

namespace App\Http\Controllers;

use App\Models\LaporanFoto;
use Illuminate\Support\Str;
use App\Models\LaporanSales;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class LaporanSalesController extends Controller
{
    public function store(Request $request)
    {
        try {
        // dd($request->hasFile('member_image'));
       // Validasi input untuk data laporan 
       $validatedLaporan = $request->validate([
        'laporan' => 'required|string|min:30', 
        'user_id' => 'required|string',
        'general_id' => 'required|string',
        'jadwal_id' => 'required|string',
        'contact_person' => 'required|string',
        'no_hp' => 'required|numeric',
        'tanggal_jadwal' => 'required|string',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ], [
        'laporan.min' => 'Tulis Laporan Yang Lengkap Dan Jelas ???.',
        'latitude.required' => 'Informasi lokasi Anda belum diizinkan. Silahkan izinkan dan aktifkan.',
        'longitude.required' => 'Informasi lokasi Anda belum diizinkan. Silahkan izinkan dan aktifkan.',
    ]);


    $laporanSales = new LaporanSales();
    $laporanSales->general_id = $validatedLaporan['general_id'];
    $laporanSales->user_id = $validatedLaporan['user_id'];
    $laporanSales->pesan = $validatedLaporan['laporan'];
    $laporanSales->latitude = $validatedLaporan['latitude'];
    $laporanSales->longitude = $validatedLaporan['longitude'];
    $laporanSales->jadwal_id = $validatedLaporan['jadwal_id'];
    $laporanSales->contact_person = $validatedLaporan['contact_person'];
    $laporanSales->no_hp = $validatedLaporan['no_hp'];
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

    return redirect('/laporan' . '/'  . $validatedLaporan['general_id'] . '/' .  $validatedLaporan['jadwal_id'] . '?tanggal=' .  $validatedLaporan['tanggal_jadwal'] )->with('success', 'Data berhasil disimpan');
} catch (\Illuminate\Validation\ValidationException $e) {
    return redirect()->back()->withErrors($e->validator->errors())->withInput();
} catch (\Exception $e) {
    return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
}
    // return response()->json(['success' => 'Data berhasil disimpan']);
    }
    public function deleteGambar($laporanFotoId)
    {
        // Temukan model LaporanFoto berdasarkan ID
        $laporanFoto = LaporanFoto::find($laporanFotoId);
    
        // Pastikan model ditemukan
        if ($laporanFoto) {
            // Dapatkan path lengkap dari gambar
            $gambarPath = public_path('laporan/' . $laporanFoto->foto);
        
            // Hapus file gambar dari sistem file
            if (File::exists($gambarPath)) {
                File::delete($gambarPath);
            }
        
            // Hapus entri dari basis data
            $laporanFoto->delete();
            
            return response()->json(['message' => 'Gambar berhasil dihapus']);
        } else {
            return response()->json(['error' => 'LaporanFoto tidak ditemukan'], 404);
        }
    }



    public function update(Request $request)
    {
        try {
        // dd($request->hasFile('member_image'));
        $validatedLaporan = $request->validate([
            'laporan' => 'required|string|min:30',
            'laporan_id' => 'required|string',
            'general_id' => 'required|string',
            'jadwal_id' => 'required|string',
            'tanggal_jadwal' => 'required|string',
            'contact_person' => 'required|string',
            'no_hp' => 'required|numeric',
        ],
        [
            'laporan.min' => 'Tulis Laporan Yang Lengkap Dan Jelas ???.',
        ]);
        $idLaporan =$validatedLaporan['laporan_id'];
        // Dapatkan laporan yang ingin diperbarui
        $laporanSales = LaporanSales::where('id', $idLaporan)
        ->where('created_at', '>=',Carbon::today()) // Pengecekan jika melebihi 1 hari
        ->firstOrFail();
        // ->where('created_at', '>=', Carbon::now()->subDay()) // Pengecekan jika melebihi 1 hari jika beda hari bukan jam
        // Update pesan dengan data yang divalidasi
        $laporanSales->pesan = $validatedLaporan['laporan'];
        $laporanSales->contact_person = $validatedLaporan['contact_person'];
        $laporanSales->no_hp = $validatedLaporan['no_hp'];
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
            $laporanFoto->laporan_sales_id =  $idLaporan; 
            $laporanFoto->foto = $name;
            $laporanFoto->nama = $validatedFoto['namafoto'][$key] ?? ''; 
            $laporanFoto->save();
        }
    }

    return redirect('/laporan' . '/'  . $validatedLaporan['general_id'] . '/' .  $validatedLaporan['jadwal_id'] . '?tanggal=' .  $validatedLaporan['tanggal_jadwal'] )->with('success', 'Data berhasil disimpan');
} catch (\Illuminate\Validation\ValidationException $e) {
    return redirect()->back()->withErrors($e->validator->errors())->withInput();
} catch (\Exception $e) {
    return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: Sudah Melebih Batas Waktu Edit']);
}
    }
}
