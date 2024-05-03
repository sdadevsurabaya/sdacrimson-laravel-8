<?php

namespace App\Http\Controllers\Api\General;

use JWTAuth;
use Illuminate\Http\Request;
use App\Models\General_model;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\API\BaseController as BaseController;

class PostGeneralController extends Controller
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

            //valid credential
            $validatorToken = Validator::make($request->only('token'), [
                'token' => 'required'
            ]);

            //Send failed response if request is not valid
            if ($validatorToken->fails()) {
                return response()->json(['error' => $validatorToken->messages()], 200);
            }

            $validatorRequest = Validator::make($input, [
                'type_usaha' => 'required',
                'nama_usaha' => 'required',
                'jabatan' => 'required',
                'alamat_kantor' => 'required',
                'nama_lengkap' => 'required',
                'mobile_phone' => 'required',
            ]);


            if ($validatorRequest->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validatorRequest->errors(),
                ], 200);
            }


            // check data if empty default null if exist take id_customer from last created data
            $data = General_model::count();
            if ($data == 0) {
                $id = 0;
            } else {
                $getId = General_model::orderBy('id', 'desc')->get();
                $id = $getId[0]->id_customer;
            }

            $covert_huruf_besar = strtoupper($request->nama_usaha);
            $huruf = substr($covert_huruf_besar, 0, 3);
            // $data = General_model::orderBy('id','desc')->get(['general_informations.id as id_general']);
            // $urutan = $data[0]->id_general;
            $urutan = substr($id, -3);
            // $urutan = "LAN-001";
            $urutan++;
            $id_customer = $huruf . "-" . sprintf("%03s", $urutan);
            //parse token get user login
            $user = JWTAuth::parseToken()->authenticate();

            $now = Carbon::now();
            $createdDate = $now->format('Y-m-d');

            //get role user login
            $userId = $user->id;

            $input['id_customer'] = $id_customer;
            $input['jabatan'] = 'Pemilik';
            $input['ar'] = $userId;
            $input['created_by'] = $userId;
            $input['created_date'] = $createdDate;




            $generalCreate = General_model::create($input);

            $data = [
                'success' => true,
                'message' => 'General created successfully.',
                'id_customer' => $generalCreate->id_customer
            ];
            // $data = [
            //     'success' => true,
            //     'message' => 'General created successfully.',
            //     'id_customer' => $generalCreate->id_customer,
            // ];

            return $data;
        } catch (\Throwable $th) {
            return $this->sendError('General created Failed.', $th->getMessage());
        }
    }
}
