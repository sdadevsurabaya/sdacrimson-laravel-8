<?php

namespace App\Http\Controllers\Api\Outlet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Outlet_model;
use Symfony\Component\HttpFoundation\Response;

class GetOutletController extends Controller
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
        
        $id = $request->input('id');

        $OutletQuery = Outlet_model::all();
         // check request id outlet
         if ($id) {
            $outletId = $OutletQuery->find($id);
           
            //if id exist run this
            if ($outletId) {
                return response()->json([
                    'success' => true,
                    'message' => 'Get outlet Id',
                    'data' => $outletId
                ], Response::HTTP_OK);
            }
            //if id is not in db
            return response()->json([
                'erorr' => true,
                'message' => 'Get outlet Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        // get data outlet all data
        return response()->json([
            'success' => true,
            'message' => 'Get outlet All',
            'data' => $OutletQuery
        ], Response::HTTP_OK);


    }
}