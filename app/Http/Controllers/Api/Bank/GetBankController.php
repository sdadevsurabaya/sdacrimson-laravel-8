<?php

namespace App\Http\Controllers\Api\Bank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank_model;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class GetBankController extends Controller
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


        $BankQuery = Bank_model::select('bank')->distinct()->pluck('bank')->toArray();


        // get data Bank all data
        return response()->json([
            'success' => true,
            'message' => 'Get Bank All',
            'data' => $BankQuery
        ], Response::HTTP_OK);
    }
}
