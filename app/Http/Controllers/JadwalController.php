<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\LocationTime;
use Illuminate\Support\Facades\Auth;


class JadwalController extends Controller
{
    public function index()
    {
        return view('jadwal.index');
    }

    public function create()
    {
        $authUser = auth()->user();

        // Filter daftar user berdasarkan role yang sedang login
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        if ($authUser->hasRole('Logistik')) {
            // Logistik hanya bisa memilih user ber-role Driver
            $users = User::role('Driver')->pluck('name', 'id');
            $driverIds = User::role('Driver')->pluck('id');
            $jadwals = Jadwal::with('user')
                ->whereIn('user_id', $driverIds)
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->orderBy('date', 'desc')
                ->withTrashed()->whereNull('deleted_at')->get();
        } elseif ($authUser->hasRole('Admin')) {
            $users = User::pluck('name', 'id');
            $jadwals = Jadwal::with('user')
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->orderBy('date', 'desc')
                ->withTrashed()->whereNull('deleted_at')->get();
        } else {
            $users = User::pluck('name', 'id');
            $jadwals = Jadwal::with('user')
                ->where('user_id', Auth::id())
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->orderBy('date', 'desc')
                ->withTrashed()->whereNull('deleted_at')->get();
        }

        $start = LocationTime::where('user_id', Auth::id())->whereDate('created_at', now())
            ->where('type', 'start')
            ->orderBy('id', 'desc')
            ->first();

        $stop = LocationTime::where('user_id', Auth::id())->whereDate('created_at', now())
            ->where('type', 'stop')
            ->orderBy('id', 'desc')
            ->first();

        return view('jadwal.createJadwal', compact('users', 'jadwals', 'start', 'stop'));
    }

    public function exportJadwal()
    {

        $users = User::pluck('name', 'id');
        return view('jadwal.exportJadwal', compact('users'));
    }

    public function previewJadwal(Request $request)
    {
        $year =  Carbon::now()->year;
        $month = $request->month;
        $user = $request->user_id;


        $jadwals = Jadwal::whereYear('date', $year)
            ->whereMonth('date',  $month)
            ->where('user_id', $user)
            ->with(['detailJadwals.generalInformation'])
            ->get();


        $result = [];

        // Buat daftar semua tanggal dalam bulan yang diberikan
        $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($year, $month, $day);
            $formattedDate = $date->format('d-m-Y');
            $dayOfWeek = $date->format('l');
            $result[$formattedDate] = [
                'day' => $dayOfWeek,
                'businesses' => []
            ];
        }

        // Loop melalui setiap jadwal
        foreach ($jadwals as $jadwal) {
            $date = Carbon::parse($jadwal->date);
            $formattedDate = $date->format('d-m-Y');

            // Loop melalui setiap detail jadwal
            foreach ($jadwal->detailJadwals as $detailJadwal) {
                if ($detailJadwal->generalInformation) {
                    $result[$formattedDate]['businesses'][] = $detailJadwal->generalInformation->nama_usaha;
                }
            }
        }


        // dd($result);
        return view('jadwal.previewJadwal', compact('result'));
    }

    public function store(Request $request)
    {


        $user = auth()->user();

        if ($user->hasRole('Sales')) {
            // Sales hanya bisa buat jadwal untuk dirinya sendiri
            $request->merge(['user_id' => $user->id]);
        } elseif ($user->hasRole('Admin') || $user->hasRole('Logistik')) {
            // Admin & Logistik bebas memilih user_id dari form
        } else {
            $request->merge(['user_id' => $user->id]);
        }

        // Validasi
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
        ]);

        // Generate kode unik
        $randomString = strtoupper(Str::random(5));
        $validatedData['kode'] = 'JD-' . now()->format('Y/m/d') . '-' . $randomString;
        $validatedData['created_by_id'] = $user->id;

        // Simpan ke database
        $jadwal = Jadwal::create($validatedData);

        return response()->json([
            'message' => 'Jadwal created successfully',
            'jadwal' => $jadwal,
        ], 200);
    }


    public function edit($id)
    {
        $jadwal = Jadwal::find($id);
        return response()->json($jadwal);
    }


    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::find($id);
        $newDate = $request->input('date');

        if (strtotime($newDate) < strtotime(date('Y-m-d'))) {
            return response()->json(['success' => false, 'message' => 'Tanggal tidak boleh mundur dari tanggal sekarang']);
        }

        // Jika tidak ada, update tanggal
        $jadwal->modified_by_id =  Auth::id();
        $jadwal->date = $newDate;
        $jadwal->save();

        // Cek apakah tanggal baru sudah ada di database
        // $existingJadwal = Jadwal::where('date', $newDate)->where('id', '!=', $id)->first();

        // if ($existingJadwal) {
        //     return response()->json(['success' => false, 'message' => 'Tanggal sudah ada di Buat Schedule']);
        // }

        // Jika tidak ada, update tanggal
        // $jadwal->date = $newDate;
        // $jadwal->save();

        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate']);
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        if ($jadwal) {
            $jadwal->delete(); // Ini akan melakukan soft delete jika model Anda menggunakan soft deletes
            return response()->json(['success' => true, 'message' => 'Jadwal berhasil dibatalkan']);
        } else {
            return response()->json(['success' => false, 'message' => 'Jadwal tidak ditemukan']);
        }
    }

    public function getGeneralInformationsByMonth()
    {

        $year = 2024;
        $month = 6;
        $jadwals = Jadwal::whereYear('date', 2024)
            ->whereMonth('date', 6)
            ->with(['detailJadwals.generalInformation'])
            ->get();

        $result = [];

        // Buat daftar semua tanggal dalam bulan yang diberikan
        $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($year, $month, $day);
            $formattedDate = $date->format('Y-m-d');
            $dayOfWeek = $date->format('l');
            $result[$formattedDate] = [
                'day' => $dayOfWeek,
                'businesses' => []
            ];
        }

        // Loop melalui setiap jadwal
        foreach ($jadwals as $jadwal) {
            $date = Carbon::parse($jadwal->date);
            $formattedDate = $date->format('Y-m-d');

            // Loop melalui setiap detail jadwal
            foreach ($jadwal->detailJadwals as $detailJadwal) {
                if ($detailJadwal->generalInformation) {
                    $result[$formattedDate]['businesses'][] = $detailJadwal->generalInformation->nama_usaha;
                }
            }
        }

        return $result;
    }
}
