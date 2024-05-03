<?php

namespace App\Http\Controllers\Api\Contact_person;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactPerson_model;
use Symfony\Component\HttpFoundation\Response;

class GetContactPersonController extends Controller
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
        
        $id = $request->input('id');

        $ContactPersonQuery = ContactPerson_model::all();
         // check request id ContactPerson
         if ($id) {
            $ContactPersonId = $ContactPersonQuery->find($id);
           
            //if id exist run this
            if ($ContactPersonId) {
                return response()->json([
                    'success' => true,
                    'message' => 'Get ContactPerson Id',
                    'data' => $ContactPersonId
                ], Response::HTTP_OK);
            }
            //if id is not in db
            return response()->json([
                'erorr' => true,
                'message' => 'Get ContactPerson Not Found',
            ], Response::HTTP_NOT_FOUND);
        }

        // get data ContactPerson all data
        return response()->json([
            'success' => true,
            'message' => 'Get ContactPerson All',
            'data' => $ContactPersonQuery
        ], Response::HTTP_OK);


    }
}