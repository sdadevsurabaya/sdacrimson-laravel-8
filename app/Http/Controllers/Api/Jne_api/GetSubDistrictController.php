<?php

namespace App\Http\Controllers\Api\Jne_api;

use api;
use App\Models\JNE_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class GetSubDistrictController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {

        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $province = $request->province_name;
        $city = $request->city_name;
        $district = $request->district_name;

        $getJneSubDistrict = JNE_model::select('subdidstrict_name')->where('province_name', $province)->where('city_name', $city)->where('district_name', $district)->distinct()->pluck('subdidstrict_name')->toArray();
        $getJneZipCode = JNE_model::select('zip_code')->where('province_name', $province)->where('city_name', $city)->where('district_name', $district)->distinct()->pluck('zip_code')->toArray();

        $data = [
            'success' => true,
            'GetName' => $getJneSubDistrict,
            'GetZipCode' => $getJneZipCode,
        ];

        $zipCode = array_shift($data["GetZipCode"]);

        $data["GetZipCode"] = $zipCode;
        return $data;

        // return $this->sendResponse($data, 'Get All Sub District Where Province and City and District.');
    }
}
