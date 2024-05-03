<?php

namespace App\Http\Controllers\Api\Berkas_General;


use App\Models\Legal_model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class UpdateBerkasLegalController extends Controller
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
            $editLegal = Legal_model::find($request->id);


            $editLegal->tahun_berdiri = $request->tahun_berdiri;
            $editLegal->no_siup = $request->no_siup;
            $editLegal->no_tdp = $request->no_tdp;
            $editLegal->remarks = $request->remarks;
            $editLegal->status = $request->status;
            $editLegal->update_date = $createdDate;
            $editLegal->update_time = $formattedTime;
            $editLegal->update_by = $userId;

            $editLegal->save();

            $data = [
                'success' => true,
                'message' => 'Update Detail Legal Success',
                // 'data' => $editLegal

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
