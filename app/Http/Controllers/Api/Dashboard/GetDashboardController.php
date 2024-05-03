<?php

namespace App\Http\Controllers\Api\Dashboard;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\General_model;
use App\Models\Legal_model;
use App\Models\ContactPerson_model;
use App\Models\Outlet_model;
use Illuminate\Support\Facades\DB;

class GetDashboardController extends Controller
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

        //parse token get user login
        $user = JWTAuth::parseToken()->authenticate();
        $userId = $user->id;
        $userRole = DB::select('select u.*, r.name as role from users as u inner join model_has_roles as ur on u.id = ur.model_id inner join roles as r on ur.role_id = r.id where u.id = "'.$userId.'"');
   

        //get role user login
       
    

        if ($userRole[0]->role == 'Sales' ) {
            // dd("Sales " . $id_user);
            $get_general = General_model::where('ar', $userId)->count();

            $get_legal = Legal_model::where('ar', $userId)->count();

            $get_kontak = ContactPerson_model::where('ar', $userId)->count();

            $get_outlet = Outlet_model::where('ar', $userId)->count();
            $data = [
                'general' => $get_general,
                'legal' => $get_legal,
                'kontak' => $get_kontak,
                'outlet' => $get_outlet,
            ];
        } else {
            // dd("buklan sales");
            $get_general = General_model::count();

            $get_legal = Legal_model::count();

            $get_kontak = ContactPerson_model::count();

            $get_outlet = Outlet_model::count();

         

        }
    

    // get data general all data
    return response()->json([
        'success' => true,
        'message' => 'Get Dahsboard Count',
        'general' => $get_general,
        'legal' => $get_legal,
        'kontak' => $get_kontak,
        'outlet' => $get_outlet
    ], Response::HTTP_OK);
    }
}