<?php

namespace App\Http\Controllers\Api\Berkas_General;

use JWTAuth;
use App\Models\Legal_model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ContactPerson_model;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class UpdateBerkasContactController extends Controller
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
            $editContact = ContactPerson_model::find($request->id);


            $editContact->nama_lengkap = $request->nama_lengkap;
            $editContact->no_telpon = $request->no_telpon;
            $editContact->email = $request->email;
            $editContact->jabatan = $request->jabatan;
            $editContact->status = $request->status;
            $editContact->update_date = $createdDate;
            $editContact->update_time = $formattedTime;
            $editContact->update_by = $userId;

            $editContact->save();

            $data = [
                'success' => true,
                'message' => 'Update Detail Contact Success',
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
