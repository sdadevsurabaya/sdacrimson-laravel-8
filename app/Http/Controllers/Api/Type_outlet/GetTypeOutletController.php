<?php

namespace App\Http\Controllers\Api\Type_outlet;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General_model;
use Illuminate\Support\Facades\Validator;
use App\Models\TypeOutlet_model;
use Symfony\Component\HttpFoundation\Response;

class GetTypeOutletController extends Controller
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
            $validator = Validator::make($request->only('token'), [
                'token' => 'required'
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            $id = $request->input('id');


            $user = JWTAuth::parseToken()->authenticate();

            //get role user login
            $userId = $user->id;







            $TypeOutletQuery = TypeOutlet_model::all();
            // check request id outlet
            if ($id) {
                $outletId = $TypeOutletQuery->find($id);

                //if id exist run this
                if ($outletId) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Get Type outlet Id',
                        'data' => $outletId->type_outlet
                    ], Response::HTTP_OK);
                }
                //if id is not in db
                return response()->json([
                    'erorr' => true,
                    'message' => 'Get Type outlet Not Found',
                ], Response::HTTP_NOT_FOUND);
            }

            $data = [
                'success' => true,
                'message' => 'Get Type outlet All',
                'data' => $TypeOutletQuery->pluck('type_outlet')
            ];


            return $data;
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
