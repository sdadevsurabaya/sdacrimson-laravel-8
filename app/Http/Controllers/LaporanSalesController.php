<?php

namespace App\Http\Controllers;

use App\Models\LaporanFoto;
use App\Models\General_model;
use Illuminate\Support\Str;
use App\Models\LaporanSales;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth; // 🔥 tambahkan ini




class LaporanSalesController extends Controller
{
    // public function store(Request $request)
    // {
    //     try {
    //         // dd($request->hasFile('member_image'));
    //         // Validasi input untuk data laporan
    //         $validatedLaporan = $request->validate([
    //             'laporan' => 'required|string|min:30',
    //             'user_id' => 'required|string',
    //             'general_id' => 'required|string',
    //             'jadwal_id' => 'required|string',
    //             'contact_person' => 'required|string',
    //             'no_hp' => 'required|numeric',
    //             'tanggal_jadwal' => 'required|string',
    //             // 'latitude' => 'required|numeric',
    //             // 'longitude' => 'required|numeric',
    //         ], [
    //             'laporan.min' => 'Tulis Laporan Yang Lengkap Dan Jelas!!!',
    //             'latitude.required' => 'Informasi lokasi Anda belum diizinkan. Silahkan izinkan dan aktifkan.',
    //             'longitude.required' => 'Informasi lokasi Anda belum diizinkan. Silahkan izinkan dan aktifkan.',
    //         ]);


    //         $laporanSales = new LaporanSales();
    //         $laporanSales->general_id = $validatedLaporan['general_id'];
    //         $laporanSales->user_id = $validatedLaporan['user_id'];
    //         $laporanSales->pesan = $validatedLaporan['laporan'];
    //         // $laporanSales->latitude = $validatedLaporan['latitude'];
    //         // $laporanSales->longitude = $validatedLaporan['longitude'];
    //         $laporanSales->jadwal_id = $validatedLaporan['jadwal_id'];
    //         $laporanSales->contact_person = $validatedLaporan['contact_person'];
    //         $laporanSales->no_hp = $validatedLaporan['no_hp'];
    //         $laporanSales->save();


    //         $validatedFoto = $request->validate([
    //             'member_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
    //             'namafoto.*' => 'nullable|string',
    //         ]);



    //         if ($request->hasFile('member_image')) {
    //             foreach ($request->file('member_image') as $key => $file) {

    //                 $now = Carbon::now();
    //                 $formattedDate = $now->format('Ymd_');
    //                 $name = $formattedDate . Str::random(5) . '.' . $file->getClientOriginalExtension();
    //                 $path = public_path('laporan/' . $name);
    //                 Image::make($file)->resize(750, null, function ($constraint) {
    //                     $constraint->aspectRatio();
    //                 })->save($path);


    //                 $laporanFoto = new LaporanFoto();
    //                 $laporanFoto->laporan_sales_id = $laporanSales->id;
    //                 $laporanFoto->foto = $name;
    //                 $laporanFoto->nama = $validatedFoto['namafoto'][$key] ?? '';
    //                 $laporanFoto->save();
    //             }
    //         }

    //         return redirect('/laporan' . '/'  . $validatedLaporan['general_id'] . '/' .  $validatedLaporan['jadwal_id'] . '?tanggal=' .  $validatedLaporan['tanggal_jadwal'])->with('success', 'Data berhasil disimpan');
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         return redirect()->back()->withErrors($e->validator->errors())->withInput();
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
    //     }
    //     // return response()->json(['success' => 'Data berhasil disimpan']);
    // }

    public function store(Request $request)
    {
        try {
            // Validasi input untuk data laporan
            $rules = [
                'laporan' => 'required|string|min:30',
                'user_id' => 'required|string',
                'general_id' => 'required|string',
                'jadwal_id' => 'required|string',
                'tanggal_jadwal' => 'required|string',
            ];

            if (!(Auth::user()->hasRole('Collector') || Auth::user()->hasRole('Driver'))) {
                $rules['contact_person'] = 'required|string';
                $rules['no_hp'] = 'required|numeric';
            } else {
                $rules['contact_person'] = 'nullable|string';
                $rules['no_hp'] = 'nullable|numeric';
            }

            $validatedLaporan = $request->validate($rules, [
                'laporan.min' => 'Tulis Laporan Yang Lengkap Dan Jelas!!!',
                'latitude.required' => 'Informasi lokasi Anda belum diizinkan. Silahkan izinkan dan aktifkan.',
                'longitude.required' => 'Informasi lokasi Anda belum diizinkan. Silahkan izinkan dan aktifkan.',
            ]);

            // Simpan ke tabel laporan_sales
            $laporanSales = new LaporanSales();
            $laporanSales->general_id = $validatedLaporan['general_id'];
            $laporanSales->user_id = $validatedLaporan['user_id'];
            $laporanSales->pesan = $validatedLaporan['laporan'];
            $laporanSales->jadwal_id = $validatedLaporan['jadwal_id'];
            if (!(Auth::user()->hasRole('Collector') || Auth::user()->hasRole('Driver'))) {
                $laporanSales->contact_person = $request->input('contact_person');
                $laporanSales->no_hp = $request->input('no_hp');
            }
            $laporanSales->save();

            // ✅ Sinkronisasi data customer ke general_information
            if (!(Auth::user()->hasRole('Collector') || Auth::user()->hasRole('Driver'))) {
                $general = \App\Models\General_model::find($validatedLaporan['general_id']);
    
                if ($general) {
                    // Jika sudah ada, update nama & no HP
                    $general->nama_lengkap = $request->input('contact_person');
                    $general->mobile_phone = $request->input('no_hp');
                    $general->save();
                } else {
                    // Jika belum ada, buat baru
                    \App\Models\General_model::create([
                        'id' => $validatedLaporan['general_id'],
                        'nama_lengkap' => $request->input('contact_person'),
                        'mobile_phone' => $request->input('no_hp'),
                    ]);
                }
            }

            // Validasi dan simpan foto (jika ada)
            $validatedFoto = $request->validate([
                'member_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
                'namafoto.*' => 'nullable|string',
            ]);

            if ($request->hasFile('member_image')) {
                foreach ($request->file('member_image') as $key => $file) {
                    $now = \Carbon\Carbon::now();
                    $formattedDate = $now->format('Ymd_');
                    $name = $formattedDate . \Str::random(5) . '.' . $file->getClientOriginalExtension();
                    $path = public_path('laporan/' . $name);

                    \Intervention\Image\Facades\Image::make($file)
                        ->resize(750, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->save($path);

                    $laporanFoto = new \App\Models\LaporanFoto();
                    $laporanFoto->laporan_sales_id = $laporanSales->id;
                    $laporanFoto->foto = $name;
                    $laporanFoto->nama = $validatedFoto['namafoto'][$key] ?? '';
                    $laporanFoto->save();
                }
            }

            return redirect('/laporan/' . $validatedLaporan['general_id'] . '/' . $validatedLaporan['jadwal_id'] . '?tanggal=' . $validatedLaporan['tanggal_jadwal'])
                ->with('success', 'Data berhasil disimpan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
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
            $rulesUpdate = [
                'laporan' => 'required|string|min:30',
                'laporan_id' => 'required|string',
                'general_id' => 'required|string',
                'jadwal_id' => 'required|string',
                'tanggal_jadwal' => 'required|string',
            ];

            if (!(Auth::user()->hasRole('Collector') || Auth::user()->hasRole('Driver'))) {
                $rulesUpdate['contact_person'] = 'required|string';
                $rulesUpdate['no_hp'] = 'required|numeric';
            } else {
                $rulesUpdate['contact_person'] = 'nullable|string';
                $rulesUpdate['no_hp'] = 'nullable|numeric';
            }

            $validatedLaporan = $request->validate($rulesUpdate, [
                'laporan.min' => 'Tulis Laporan Yang Lengkap Dan Jelas!!!',
            ]);

            $idLaporan = $validatedLaporan['laporan_id'];

            // Ambil data laporan
            $laporanSales = LaporanSales::where('id', $idLaporan)
                ->where('created_at', '>=', Carbon::today())
                ->firstOrFail();

            // Update laporan
            $laporanSales->pesan = $validatedLaporan['laporan'];
            if (!(Auth::user()->hasRole('Collector') || Auth::user()->hasRole('Driver'))) {
                $laporanSales->contact_person = $request->input('contact_person');
                $laporanSales->no_hp = $request->input('no_hp');
            }
            $laporanSales->save();

            /**
             * === Sinkronisasi ke tabel general_informations ===
             * update kalau sudah ada (berdasarkan general_id)
             */
            if (!(Auth::user()->hasRole('Collector') || Auth::user()->hasRole('Driver'))) {
                $general = General_model::find($laporanSales->general_id);
    
                if ($general) {
                    $general->update([
                        'nama_lengkap' => $request->input('contact_person'),
                        'mobile_phone' => $request->input('no_hp'),
                        'update_date'  => now()->format('Y-m-d'),
                        'update_time'  => now()->format('H:i:s'),
                        'update_by'    => Auth::user()->id,
                    ]);
                }
            }

            /**
             * === Upload foto laporan (jika ada) ===
             */
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
                    $laporanFoto->laporan_sales_id = $idLaporan;
                    $laporanFoto->foto = $name;
                    $laporanFoto->nama = $validatedFoto['namafoto'][$key] ?? '';
                    $laporanFoto->save();
                }
            }

            return redirect('/laporan/' . $validatedLaporan['general_id'] . '/' . $validatedLaporan['jadwal_id'] . '?tanggal=' . $validatedLaporan['tanggal_jadwal'])
                ->with('success', 'Data berhasil disimpan dan disinkronkan dengan data customer');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }
}
