<?php

namespace App\Http\Controllers;

use App\Models\Jarak;
use App\Models\Attendance;
use Illuminate\Support\Str;
use App\Models\DetailJadwal;
use App\Models\LocationTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{



    private    function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'general_id' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:8048',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'note' => 'nullable|string',
            'status' => 'required|string',
            'iduser' => 'required|string',
            'id_jadwal' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['succes' => false, 'message' => $validator->errors()], 422);
        }

        // // Pengecekan jarak
        // $latitudeFrom = -7.251100291890603;
        // $longitudeFrom = 112.7328919383071;
        // $latitudeTo = $request->input('latitude');
        // $longitudeTo = $request->input('longitude');

        // $distance = $this->haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo);

        // // Jika jarak lebih dari 1km (1000 meters), kembalikan response error
        // if ($distance > 500) {
        //     return response()->json(['success' => false, 'message' => 'Jarak terlalu jauh, tidak bisa insert data'], 422);
        // }


        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            if ($request->status == 'check in') {
                $status = 'checkin_';
            } else {
                $status = 'checkout_';
            }

            $now = Carbon::now();
            $formattedDate = $now->format('Ymd_');
            $name = $status . $formattedDate . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $path = public_path('attendance/' . $name);
            Image::make($file)->resize(750, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
        }

        $updateJadwal = DetailJadwal::where('jadwal_id', $request->input('id_jadwal'))->where('general_id', $request->input('general_id'))->first();

        if($request->status == 'check in'){
            $updateJadwal->checkin = now(); 
            $updateJadwal->save(); 


            $getAttendance = Attendance::where('user_id',  $request->input('iduser'))
            ->where('status', 'check in')
            ->whereDate('created_at', now())
            ->orderBy('id', 'desc')
            ->first();

            $waktuStart = LocationTime::where('user_id',  $request->input('iduser'))->whereDate('created_at', now())
            ->where('type', 'start')
            ->orderBy('id', 'desc')
            ->first();

              
                if (!$waktuStart) {
                    return response()->json([
                        'success' => false, 
                        'message' => [
                            'start' => ['Anda Belum Melakukan Klik Start, Silahkan Klik Tombol Start Di Halaman Jadwal Dahulu']
                        ]
                    ], 422);
                }

            if ($getAttendance) {
                $latitudeA = $getAttendance->latitude;
                $longitudeA = $getAttendance->longitude;
                $durations = $getAttendance->created_at;
            } else {
                $latitudeA = $waktuStart->latitude;
                $longitudeA = $waktuStart->longitude;
                $durations = $waktuStart->created_at;
            }



 
            $latitudeB =  $request->input('latitude');
            $longitudeB = $request->input('longitude');

            $url = "https://trueway-directions2.p.rapidapi.com/FindDrivingRoute?stops={$latitudeA},{$longitudeA}%3B{$latitudeB},{$longitudeB}&optimize=true&avoid_highways=true&avoid_tolls=false";


            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: trueway-directions2.p.rapidapi.com",
                "x-rapidapi-key: a609f59694msh3a613d81b9324b6p12364ajsn8a35271dfcb9"
              ],
            ]);
         
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            $data = json_decode($response, true);
            
          
            $distance = $data['route']['distance'] ?? -1;
            $duration = $data['route']['duration'] ?? -1;
            
            $created_at = Carbon::parse($durations);
            $now = Carbon::now();
            $diff_in_minutes = $now->diffInMinutes($created_at);


            Jarak::create([
                'general_id' => $request->input('general_id'),
                'user_id' =>  $request->input('iduser'),
                'jadwal_id' =>$request->input('id_jadwal'),
                'latitude1' =>   $latitudeA ,
                'longitude1' => $longitudeA ,
                'latitude2' => $latitudeB,
                'longitude2' =>$longitudeB,
                'distance' => $distance,
                'duration' => $duration ,
                'duration_web' => $diff_in_minutes,
            ]);


        }else{
            $updateJadwal->checkout = now(); 
            $updateJadwal->save(); 
        }
     


        $attendance = Attendance::create([
            'user_id' => $request->input('iduser'),
            'general_id' => $request->input('general_id'),
            'foto' =>  $name,
            'status' => $request->input('status'),
            'jadwal_id' => $request->input('id_jadwal'),
            'note' => $request->input('note'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        // $attendance = Attendance::updateOrCreate(
        //     [
        //         'user_id' => $request->input('iduser'),
        //         'general_id' => $request->input('general_id'),
        //         'jadwal_id' => $request->input('id_jadwal')
        //     ],
        //     [
        //         'foto' =>  $name,
        //         'status' => $request->input('status'),
        //         'note' => $request->input('note'),
        //         'latitude' => $request->input('latitude'),
        //         'longitude' => $request->input('longitude')
        //     ]
        // );
        
        return response()->json(['succes' => true,  'message' => 'Checked in successfully', 'attendance' => $attendance], 200);
    }


    public function getAttendanceDetails($id)
    {
        $attendance = Attendance::with('user')->findOrFail($id);

        $attendance->foto = asset('attendance/' . $attendance->foto);
        return response()->json($attendance);
    }
}
