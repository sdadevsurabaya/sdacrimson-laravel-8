<?php

namespace App\Http\Controllers\Api\Account;

use JWTAuth;
use Illuminate\Http\Request;
use App\Models\Account_model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\General_model;
use App\Http\Controllers\Controller;

class PostAccountController extends Controller
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
                'id_customer' => 'required',
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                ], 200);
            }

            $input = $request->all();
            $user = JWTAuth::parseToken()->authenticate();

            $now = Carbon::now();
            $createdDate = $now->format('Y-m-d');

            //get role user login
            $userId = $user->id;
            // $getId = General_model::where('ar', $userId)->orderBy('created_at', 'desc')->first();
            // $id_customer = $getId->id_customer;




            if ($request->has('payment_trems')) {
                // $input['id_customer'] = $id_customer;
                $input['ar'] = $userId;
                $input['created_by'] = $userId;
                $input['created_date'] = $createdDate;
                $input['status'] = "Aktif";
                Account_model::create($input);
                return response()->json([
                    'success' => true,
                    'message' => 'Account created successfully.',
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Account blank',
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
