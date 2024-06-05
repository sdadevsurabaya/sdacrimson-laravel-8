<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class JadwalController extends Controller
{
    public function index(){
        return view('jadwal.index');
    }

    public function create(){

        $users = User::pluck('name', 'id');

        $hasRole = auth()->user()->hasRole('Sales');

        if( $hasRole){
            $jadwals = Jadwal::where('user_id', Auth::id())->orderBy('created_at','desc')->withTrashed()->whereNull('deleted_at')->get();
        }else {
            $jadwals = Jadwal::orderBy('created_at', 'desc')->withTrashed()->whereNull('deleted_at')->get();

        }

        return view('jadwal.createJadwal', compact('users', 'jadwals'));
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required',
            'date' => 'required|date',
        ]);

        $randomString = strtoupper(Str::random(5));
        // Generate INV (Invoice)
        $randomInvoice = 'JD-' . now()->format('Y/m/d') . '-' . $randomString;
        $validatedData['kode'] = $randomInvoice;
        $validatedData['created_by_id'] = Auth::id();

        // Create a new Jadwal record
        $jadwal = Jadwal::create($validatedData);

        // Return a response
        return response()->json([
            'message' => 'Jadwal created successfully',
            'jadwal' => $jadwal,
        ], 200);
    }

<<<<<<< HEAD
=======
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


    // Cek apakah tanggal baru sudah ada di database
    // $existingJadwal = Jadwal::where('date', $newDate)->where('id', '!=', $id)->first();
    
    // if ($existingJadwal) {
    //     return response()->json(['success' => false, 'message' => 'Tanggal sudah ada di Buat Schedule']);
    // }

    // Jika tidak ada, update tanggal
    $jadwal->date = $newDate;
    $jadwal->save();

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

    
>>>>>>> origin/eko
}
