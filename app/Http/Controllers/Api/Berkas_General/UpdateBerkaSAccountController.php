<?php

namespace App\Http\Controllers\Api\Berkas_General;

use JWTAuth;
use App\Models\Legal_model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ContactPerson_model;

use App\Http\Controllers\Controller;
use App\Models\Account_model;
use Illuminate\Support\Facades\Validator;


class UpdateBerkaSAccountController extends Controller
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
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }


            $now = Carbon::now();
            $createdDate = $now->format('Y-m-d');
            $formattedTime = $now->format('H:i:s');

            $user = JWTAuth::parseToken()->authenticate();
            //get role user login
            $userId = $user->id;
            $editContact = Account_model::find($request->id);


            $editContact->payment_trems = $request->payment_trems;
            $editContact->id_price = $request->id_price;
            $editContact->credit_limit = $request->credit_limit;
            $editContact->max_nota = $request->max_nota;
            $editContact->bank = $request->bank;
            $editContact->atas_nama = $request->atas_nama;
            $editContact->no_rek = $request->no_rek;
            $editContact->cabang = $request->cabang;
            $editContact->status = $request->status;
            $editContact->remarks = $request->remarks;
            $editContact->update_date = $createdDate;
            $editContact->update_time = $formattedTime;
            $editContact->update_by = $userId;

            $editContact->save();

            $data = [
                'success' => true,
                'message' => 'Update Detail Account Success',
                // 'data' => $editContact

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
