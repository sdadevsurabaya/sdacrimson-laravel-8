<?php

namespace App\Http\Controllers\Api\Distributor;

use JWTAuth;
use App\Models\Outlet_model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Distributor_model;
use App\Http\Controllers\Controller;
use App\Models\DetailDistributor_model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class PostDetailDistributorController extends Controller
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
        try {

            $validator = Validator::make($request->all(), [
                'id_distributor' => 'required|not_in:0',
                'brand'         => 'required',
                'id_outlet'         => 'required',
            ]);

            $strsIdDistributor = substr($request->id_distributor, 0, 8);


            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                ], 200);
            }

            $now = Carbon::now();
            $createdDate = $now->format('Y-m-d');

            $user = JWTAuth::parseToken()->authenticate();

            //get role user login
            $userId = $user->id;
            // $getOulet = Outlet_model::where('ar', $userId)->orderBy('created_at', 'desc')->first();


            $DetailDistributor = DetailDistributor_model::create([
                'id_cust'       => $strsIdDistributor,
                'id_outlet'     => $request->id_outlet,
                'brand'         => implode(",", $request->brand),
                'status'        => 'Aktif',
                'ar'            => $userId,
                'created_date'  => $createdDate,
                'created_by'    => $userId,
            ]);

            $data = [
                'success' => true,
                'message' => 'Detail Distributor created successfully.',
                'data' => $DetailDistributor->toArray()
            ];

            return $data;

            // return $this->sendResponse($DetailDistributor->toArray(), 'Distributor created successfully.');
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
