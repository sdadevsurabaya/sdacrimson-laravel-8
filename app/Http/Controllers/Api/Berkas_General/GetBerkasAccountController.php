<?php

namespace App\Http\Controllers\Api\Berkas_General;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account_model;
use App\Models\ContactPerson_model;
use App\Models\DetailDistributor_model;
use App\Models\General_model;
use App\Models\Legal_model;
use App\Models\Outlet_model;
use Illuminate\Support\Facades\Validator;


class GetBerkasAccountController extends Controller
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





        $account = Account_model::select(
            'account.id',
            'outlet.id_customer',
            'payment_trems',
            'id_price',
            'credit_limit',
            'max_nota',
            'bank',
            'atas_nama',
            'no_rek',
            'cabang',
            'account.remarks',
            'account.status',
            'users.name'
        )
            ->rightJoin('outlet', 'account.id_customer', '=', 'outlet.id_customer')
            ->join('users', 'account.ar', '=', 'users.id')
            ->groupBy('account.id')
            ->where('account.id_customer', $request->id_customer)->get();





        // dd($legals);


        // get data Distributor all data
        $data = [
            'success' => true,
            'message' => 'Get Detail Find Id Customer',
            'Account' =>  $account,
        ];


        return $data;
    }

    public function destroy(Request $request)
    {
        try {
            Account_model::findOrFail($request->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Success Delete records Detail Account.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
