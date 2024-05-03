<?php

namespace App\Http\Controllers\Api\Distributor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Distributor_model;
use App\Http\Controllers\API\BaseController as BaseController;

class PostDistributorController extends BaseController
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
        $input = $request->all();
        $validator = Validator::make($input, [
            'id_cust' => 'required',
            'type_usaha' => 'required',
            'nama_cust' => 'required',
            'address_type' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'kode_pos' => 'required',
            'latitude' => 'required',
            'longtitude' => 'required',
        ]);

        if($validator->fails()){

            return $this->sendError('Validation Error.', $validator->errors());       

        }

        $Distributor = Distributor_model::create($input);
        return $this->sendResponse($Distributor->toArray(), 'Distributor created successfully.');

    }
}