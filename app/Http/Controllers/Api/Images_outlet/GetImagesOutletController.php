<?php

namespace App\Http\Controllers\Api\Images_outlet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ImagesOutlet_model;
use Symfony\Component\HttpFoundation\Response;

class GetImagesOutletController extends Controller
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

        $ImagesOutletQuery = ImagesOutlet_model::all();
         // check request id ImagesOutlet
         if ($id) {
            $ImagesOutletId = $ImagesOutletQuery->find($id);
           
            //if id exist run this
            if ($ImagesOutletId) {
                return response()->json([
                    'success' => true,
                    'message' => 'Get ImagesOutlet Id',
                    'data' => $ImagesOutletId
                ], Response::HTTP_OK);
            }
            //if id is not in db
            return response()->json([
                'erorr' => true,
                'message' => 'Get ImagesOutlet Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        // get data ImagesOutlet all data
        return response()->json([
            'success' => true,
            'message' => 'Get ImagesOutlet All',
            'data' => $ImagesOutletQuery
        ], Response::HTTP_OK);


    }
}