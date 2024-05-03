<?php

namespace App\Http\Controllers\Api\Berkas_General;

use JWTAuth;
use App\Models\Outlet_model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Distributor_model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DetailDistributor_model;
use PhpParser\Node\Expr\AssignOp\Concat;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UpdateBerkasDistributorController extends Controller
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
            //valid credential
            $validator = Validator::make($request->all(), [
                'token' => 'required',
                'id' => 'required',
                'id_distributor' => 'required',
                'brand' => 'required',
                'status' => 'required',

            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->messages()
                ], 200);
            }
            $strsIdDistributor = substr($request->id_distributor, 0, 8);

            $now = Carbon::now();
            $createdDate = $now->format('Y-m-d');
            $formattedTime = $now->format('H:i:s');

            $user = JWTAuth::parseToken()->authenticate();

            //get role user login
            $userId = $user->id;


            $editDistributor = DetailDistributor_model::find($request->id);
            $editDistributor->id_cust = $strsIdDistributor;
            $editDistributor->brand = implode(",", $request->brand);
            $editDistributor->status = $request->status;
            $editDistributor->update_date = $createdDate;
            $editDistributor->update_time = $formattedTime;
            $editDistributor->update_by = $userId;

            $editDistributor->save();
            // $editDistributor = DetailDistributor_model::select('detail_customers.id', 'detail_customers.id_outlet', 'brand', 'status', DB::raw("CONCAT(customers.id_cust, ' | ', nama_cust) as fullName"))->where('detail_customers.id', $request->id)
            //     ->join('customers', 'detail_customers.id_cust', '=', 'customers.id_cust')->get();


            // get data Distributor all data
            $data = [
                'success' => true,
                'message' => 'Update Detail Distributor Success',

            ];


            return $data;
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
