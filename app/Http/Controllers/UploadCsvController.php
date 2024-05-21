<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadCsvController extends Controller
{
    public function index(Request $request)
    {

        // Validasi file CSV
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        // Proses file CSV
        $file = $request->file('file');

        // Baca baris demi baris
        $rows = array_map('str_getcsv', file($file));

        // Proses dan masukkan data
        foreach ($rows as $row) {
            // Proses dan masukkan data ke dalam database
            // Misalnya, jika Anda ingin memasukkan data ke dalam tabel 'nama_tabel'
            // Anda bisa menggunakan Eloquent atau Query Builder untuk melakukan insert

            // Contoh menggunakan Eloquent
            // Pastikan model Anda telah diimport
            // Gunakan try-catch untuk menangani error dengan baik
            try {
                dd($row[3]);
            } catch (\Exception $e) {
                // Tangani kesalahan jika terjadi
                // Anda bisa logging kesalahan atau memberikan respon khusus ke client
                return response()->json(['message' => 'Gagal memproses data: ' . $e->getMessage()], 500);
            }
        }

        // Respon berhasil jika tidak ada kesalahan
        return response()->json(['message' => 'Data berhasil diunggah'], 200);
    }
}
