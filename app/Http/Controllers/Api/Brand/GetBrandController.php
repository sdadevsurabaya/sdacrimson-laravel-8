<?php

namespace App\Http\Controllers\Api\Brand;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank_model;
use App\Models\Brand_model;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class GetBrandController extends Controller
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

        $BrandQuery = Brand_model::select('brand')->distinct()->pluck('brand')->toArray();


        // get data Bank all data
        return response()->json([
            'success' => true,
            'message' => 'Get ALL BRAND',
            'data' => $BrandQuery
        ], Response::HTTP_OK);
    }
}
