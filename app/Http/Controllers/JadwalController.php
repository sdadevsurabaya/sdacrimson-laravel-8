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
            $jadwals = Jadwal::where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        }else {
            $jadwals = Jadwal::orderBy('created_at','desc')->get();
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

}
