<?php

namespace App\Http\Controllers\Api\Jne_api;

use App\Models\JNE_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;

class GetDistrictController extends Controller
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

        $getJneDistrict = JNE_model::select('district_name')->where('province_name', $province)->where('city_name', $city)->distinct()->pluck('district_name')->toArray();

        return response()->json(
            [
                'success' => true,
                'message' => 'Get ALL District',
                'data' => $getJneDistrict
            ],
            Response::HTTP_OK
        );
    }
}
