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


class GetBerkasLegalController extends Controller
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



        $legal = Legal_model::select('legal.id', 'id_customer', 'tahun_berdiri', 'no_siup', 'no_tdp', 'status', 'remarks', 'users.name')
            ->where('id_customer', $request->id_customer)
            ->join('users', 'legal.ar', '=', 'users.id')->get();



        // get data Distributor all data
        $data = [
            'success' => true,
            'message' => 'Get Berkas Find Id Customer',
            'Legal' =>  $legal,
        ];


        return $data;
    }

    public function destroy(Request $request)
    {
        try {
            Legal_model::findOrFail($request->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Success Delete records Detail Legal.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
