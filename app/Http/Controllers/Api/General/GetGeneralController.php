<?php

namespace App\Http\Controllers\Api\General;

use JWTAuth;
use App\Models\Outlet_model;
use Illuminate\Http\Request;
use App\Models\General_model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class GetGeneralController extends Controller
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

        $search = $request->search;
        //parse token get user login
        $user = JWTAuth::parseToken()->authenticate();

        //get role user login
        $userId = $user->id;
        $userRole = DB::select('select u.*, r.name as role from users as u inner join model_has_roles as ur on u.id = ur.model_id inner join roles as r on ur.role_id = r.id where u.id = "' . $userId . '"');


        //check user role 
        if ($userRole[0]->role == 'Admin' || $userRole[0]->role == 'Verifikator') {
            // dd($userRole);

            if ($search) {
                $data = General_model::join("users", "users.id", "=", "general_informations.ar")
                    ->select('id_customer', 'nama_usaha', DB::raw('COALESCE(type_usaha, "") as type_usaha'), DB::raw('COALESCE(nama_lengkap, "") as nama_lengkap'), DB::raw('COALESCE(alamat_kantor, "") as alamat_kantor'), DB::raw('name as ar'))
                    ->orderBy('general_informations.id', 'desc')
                    ->Where(function ($query) use ($search, $userId) {
                        $query
                            ->orWhere('general_informations.id_customer', 'LIKE', "%$search%")
                            ->orWhere('general_informations.type_usaha', 'LIKE', "%$search%")
                            ->orWhere('general_informations.nama_lengkap', 'LIKE', "%$search%")
                            ->orWhere('general_informations.alamat_kantor', 'LIKE', "%$search%")
                            ->orWhere('users.name', 'LIKE', "%$search%")
                            ->orWhere('general_informations.nama_usaha', 'LIKE', "%$search%");
                    })
                    ->get()->toArray();
            } else {
                $data = General_model::join("users", "users.id", "=", "general_informations.ar")
                    ->select('id_customer', 'nama_usaha', DB::raw('COALESCE(type_usaha, "") as type_usaha'), DB::raw('COALESCE(nama_lengkap, "") as nama_lengkap'), DB::raw('COALESCE(alamat_kantor, "") as alamat_kantor'), DB::raw('name as ar'))
                    ->orderBy('general_informations.id', 'desc')
                    ->get()->toArray();
            }
        } else {
            if ($search) {
                // dd($search);
                $data = General_model::join("users", "users.id", "=", "general_informations.ar")
                    ->select('id_customer', 'nama_usaha', DB::raw('COALESCE(type_usaha, "") as type_usaha'), DB::raw('COALESCE(nama_lengkap, "") as nama_lengkap'), DB::raw('COALESCE(alamat_kantor, "") as alamat_kantor'), DB::raw('name as ar'))

                    ->Where(function ($query) use ($search, $userId) {
                        $query
                            ->orWhere('general_informations.id_customer', 'LIKE', "%$search%")
                            ->orWhere('general_informations.type_usaha', 'LIKE', "%$search%")
                            ->orWhere('general_informations.nama_lengkap', 'LIKE', "%$search%")
                            ->orWhere('general_informations.alamat_kantor', 'LIKE', "%$search%")
                            ->orWhere('users.name', 'LIKE', "%$search%")
                            ->orWhere('general_informations.nama_usaha', 'LIKE', "%$search%");
                    })
                    ->where('general_informations.ar', $userId)

                    ->orderBy('general_informations.id', 'desc')
                    ->get()->toArray();
            } else {

                $data = General_model::join("users", "users.id", "=", "general_informations.ar")
                    ->select('id_customer', 'nama_usaha', DB::raw('COALESCE(type_usaha, "") as type_usaha'), DB::raw('COALESCE(nama_lengkap, "") as nama_lengkap'), DB::raw('COALESCE(alamat_kantor, "") as alamat_kantor'), DB::raw('name as ar'))
                    ->where('general_informations.ar', $userId)
                    ->orderBy('general_informations.id', 'desc')
                    ->get()->toArray();
            }
        }


        //push count outlet 
        foreach ($data as &$dataGeneral) {
            $countOutlet = Outlet_model::where('id_customer', $dataGeneral['id_customer'])->count();
            $dataGeneral['jumlah_outlet'] = $countOutlet;
        }




        // get data general all data
        return response()->json([
            'success' => true,
            'message' => 'Get Home General Id Ar',
            'data' => $data
        ], Response::HTTP_OK);
    }
}
