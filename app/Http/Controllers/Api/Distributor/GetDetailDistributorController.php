<?php

namespace App\Http\Controllers\Api\Distributor;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailDistributor_model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Distributor_model;
use App\Models\Outlet_model;
use Symfony\Component\HttpFoundation\Response;

class GetDetailDistributorController extends Controller
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
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'id_outlet' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages()
            ], 200);
        }

        $detailDistributor = DetailDistributor_model::select('detail_customers.id', 'id_outlet', 'detail_customers.id_cust', 'detail_customers.status',  DB::raw("CONCAT(customers.id_cust, ' | ', nama_cust) as fullName"), 'brand')->where('id_outlet', $request->id_outlet)
            ->join('customers', 'detail_customers.id_cust', '=', 'customers.id_cust')->get();

        // get data Distributor all data
        $data = [
            'success' => true,
            'message' => 'Get Distributor Detail Where ID OUTLET',
            'data' => $detailDistributor
        ];

        return $data;
    }

    public function destroy(Request $request)
    {
        try {
            DetailDistributor_model::findOrFail($request->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Success Delete records Detail Distributor.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
