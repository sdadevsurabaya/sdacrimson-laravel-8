<?php

namespace App\Http\Controllers\Jadwal;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JadwalController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required',
            'date' => 'required|date',
            'created_by_id' => 'required|integer|exists:users,id',
        ]);

        // Create a new Jadwal record
        $jadwal = Jadwal::create($validatedData);

        // Return a response
        return response()->json([
            'message' => 'Jadwal created successfully',
            'jadwal' => $jadwal,
        ], 201);
    }
}
