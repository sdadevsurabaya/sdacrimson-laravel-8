<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Support\Str;
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
            Image::make($file)->resize(850, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
        }

        $attendance = Attendance::create([
            'user_id' => 1,
            'general_id' => $request->input('general_id'),
            'foto' =>  $name,
            'status' => $request->input('status'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return response()->json(['succes' => true,  'message' => 'Checked in successfully', 'attendance' => $attendance], 200);
    }
}
