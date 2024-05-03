<?php

namespace App\Http\Controllers\Api\Berkas_General;


use App\Models\Legal_model;
use App\Models\Outlet_model;
use Illuminate\Http\Request;
use App\Models\Account_model;
use App\Models\General_model;
use Illuminate\Support\Facades\DB;
use App\Models\ContactPerson_model;
use App\Http\Controllers\Controller;
use App\Models\DetailDistributor_model;
use Illuminate\Support\Facades\Validator;


class GetBerkasDistributorController extends Controller
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
            'id_customer' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }






        $detailDistributor = DetailDistributor_model::select(
            'detail_customers.id',
            'detail_customers.id_outlet',
            'detail_customers.id_cust',
            'nama_cust',
            'detail_customers.brand',
            'detail_customers.status',
            'users.name',
            DB::raw("CONCAT(customers.id_cust, ' | ', nama_cust) as fullName"),
            'detail_customers.status'
        )
            ->join('outlet', 'detail_customers.id_outlet', '=', 'outlet.id_outlet')
            ->join('customers', 'detail_customers.id_cust', '=', 'customers.id_cust')
            ->join('users', 'detail_customers.ar', '=', 'users.id')
            ->where('outlet.id_customer', $request->id_customer)->get();




        $idOutlet = DetailDistributor_model::join('outlet', 'detail_customers.id_outlet', '=', 'outlet.id_outlet')->where('outlet.id_customer', $request->id_customer)->distinct()->pluck('detail_customers.id_outlet');
        // get data Distributor all data
        $data = [
            'success' => true,
            'message' => 'Get Detail Find Id Distributor',
            'Distributor' => $detailDistributor,
            'idOutlet' => $idOutlet

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

    public function getOutlet(Request $request)
    {
        $dataOutlet = Outlet_model::select(
            'id_outlet',
        )
            ->where('outlet.id_customer', $request->id_customer)
            ->get();

        // get data Distributor all data
        $data = [
            'success' => true,
            'message' => 'Get Detail Find Id Outlet',
            'Distributor' => $dataOutlet,

        ];
        return $data;
    }
}
