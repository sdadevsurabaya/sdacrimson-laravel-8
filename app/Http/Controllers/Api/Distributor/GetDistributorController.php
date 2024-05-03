<?php

namespace App\Http\Controllers\Api\Distributor;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Distributor_model;
use App\Models\Outlet_model;
use Symfony\Component\HttpFoundation\Response;

class GetDistributorController extends Controller
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

        $user = JWTAuth::parseToken()->authenticate();

        //get role user login
        $userId = $user->id;

        $getIdOutlet = Outlet_model::select('id_outlet')->where('ar', $userId)->orderBy('created_at', 'desc')->first();
        if ($getIdOutlet) {
            $getIdOutlet = $getIdOutlet->toArray();
        } else {
            $getIdOutlet = [];
        }

        $DistributorQuery = Distributor_model::select(DB::raw("CONCAT(id_cust, ' | ', nama_cust) as fullName"))->distinct()->pluck('fullName')->toArray();

        // get data Distributor all data
        $data = [
            'success' => true,
            'message' => 'Get Distributor All',
            'id_outlet' => $getIdOutlet,
            'data' => $DistributorQuery
        ];

        $Outlet = array_shift($data["id_outlet"]);

        $data["id_outlet"] = $Outlet;
        return $data;
    }
}
