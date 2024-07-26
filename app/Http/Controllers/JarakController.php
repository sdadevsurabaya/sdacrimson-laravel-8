<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JarakController extends Controller
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

       
        // $latitudeFrom = -7.251100291890603;
        // $longitudeFrom = 112.7328919383071;
        // $latitudeTo = $request->input('latitude');
        // $longitudeTo = $request->input('longitude');

        // $distance = $this->haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo);

        // $distanceInKilometers = round($distance);

        // $formattedDistance = number_format($distanceInKilometers, 0, '.', ',');
        //  dd($formattedDistance);


        $latitudeA = '-7.251104602625086';
        $longitudeA = '112.73288901915333';
        $latitudeB = '-7.330698227098997';
        $longitudeB = '112.76314686912963';
        
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
// -7.25110619936574,112.73270758858806%3B-7.363867125137943,112.78970878290477
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, true);

    // Ambil nilai distance
    $distance = $data['route']['distance'];

   dd($data);
}



        // Jika jarak lebih dari 1km (1000 meters), kembalikan response error
        // if ($distance > 500) {
        //     return response()->json(['success' => false, 'message' => 'Jarak terlalu jauh, tidak bisa insert data'], 422);
        // }
    }
}
// https://serpapi.com/search.json?engine=google_maps_directions&start_coords=-7.251100291890603,112.7328919383071&end_coords=-7.330699817605592,112.76290236702198