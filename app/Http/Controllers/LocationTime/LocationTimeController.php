<?php

namespace App\Http\Controllers\LocationTime;

use App\Models\Jarak;
use App\Models\Attendance;
use App\Models\LocationTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LocationTimeController extends Controller
{
    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            'user_id' => 'required',
            'type' => 'required|in:start,stop',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'customer' => 'nullable',
        ]);


        if($request->type == 'stop'){

            $getAttendance = Attendance::where('user_id',  Auth::id())
            ->where('status', 'check in')
            ->whereDate('created_at', now())
            ->orderBy('id', 'desc')
            ->first();


            if ($getAttendance) {
                $latitudeA = $getAttendance->latitude;
                $longitudeA = $getAttendance->longitude;
                $durations = $getAttendance->created_at;
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
                'general_id' => $request->customer,
                'user_id' =>  Auth::id(),
                'jadwal_id' => 0,
                'latitude1' =>   $latitudeA ,
                'longitude1' => $longitudeA ,
                'latitude2' => $latitudeB,
                'longitude2' =>$longitudeB,
                'distance' => $distance,
                'duration' => $duration ,
                'duration_web' => $diff_in_minutes,
            ]);
        }

       
        $locationTime = LocationTime::create($validatedData);

        return response()->json([
            'message' => 'Location time recorded successfully',
        ], 201);
    }
}
