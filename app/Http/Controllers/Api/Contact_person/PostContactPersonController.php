<?php

namespace App\Http\Controllers\Api\Contact_person;

use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactPerson_model;
use App\Http\Controllers\Controller;

class PostContactPersonController extends Controller
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
            $input = $request->all();
            $validator = Validator::make($input, [
                'token' => 'required',
                'id_outlet' => 'required',
                'nama_lengkap' => 'required',
                'no_telpon' => 'required',
                'jabatan' => 'required',
                'status' => 'required',

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                ], 200);
            }

            $user = JWTAuth::parseToken()->authenticate();

            $now = Carbon::now();
            $createdDate = $now->format('Y-m-d');

            //get role user login
            $userId = $user->id;


            $input['ar'] = $userId;
            $input['created_by'] = $userId;
            $input['created_date'] = $createdDate;

            $ContactPerson = ContactPerson_model::create($input);
            return response()->json([
                'success' => true,
                'message' => 'Contact Person created successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
