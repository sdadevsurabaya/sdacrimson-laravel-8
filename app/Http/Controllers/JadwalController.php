<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

    public function exportJadwal(){

        $users = User::pluck('name', 'id');
        return view('jadwal.exportJadwal', compact('users'));
    }

    public function previewJadwal(Request $request){
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
                    $formattedDate = $date->format('d');
                    $dayOfWeek = $date->format('l');
                    $result[$formattedDate] = [
                        'day' => $dayOfWeek,
                        'businesses' => []
                    ];
                }
        
                // Loop melalui setiap jadwal
                foreach ($jadwals as $jadwal) {
                    $date = Carbon::parse($jadwal->date);
                    $formattedDate = $date->format('d');
        
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
