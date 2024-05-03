<?php

namespace App\Http\Controllers\Api\Jne_api;

use App\Models\JNE_model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use Symfony\Component\HttpFoundation\Response;

class GetCityController extends Controller
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
        $getJneCity = JNE_model::select('city_name')->where('province_name', $province)->distinct()->pluck('city_name')->toArray();


        return response()->json([
            'success' => true,
            'message' => 'Get ALL City',
            'data' => $getJneCity
        ], Response::HTTP_OK);
    }
}
