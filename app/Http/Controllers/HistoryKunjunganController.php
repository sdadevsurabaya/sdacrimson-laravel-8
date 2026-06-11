<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\General_model;
use App\Models\LaporanSales;
use Illuminate\Http\Request;

class HistoryKunjunganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Daftar semua customer yang pernah dikunjungi oleh Sales yang sedang login.
     */
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua customer yang memiliki laporan kunjungan dari user ini
        $customers = General_model::whereHas('laporanSales', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->with([
                'laporanSales' => function ($q) use ($userId) {
                    $q->where('user_id', $userId)
                      ->latest();
                }
            ])
            ->orderBy('nama_usaha', 'asc')
            ->get();

        return view('history-kunjungan.index', compact('customers'));
    }

    /**
     * Tampilkan semua laporan kunjungan untuk satu customer.
     */
    public function show($id)
    {
        $userId = Auth::id();

        $customer = General_model::findOrFail($id);

        $laporan = LaporanSales::with(['gambar', 'user'])
            ->where('general_id', $id)
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('history-kunjungan.show', compact('customer', 'laporan'));
    }
}
