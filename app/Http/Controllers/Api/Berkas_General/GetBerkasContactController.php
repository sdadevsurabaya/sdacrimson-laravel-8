<?php

namespace App\Http\Controllers\Api\Berkas_General;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account_model;
use App\Models\ContactPerson_model;
use App\Models\DetailDistributor_model;
use App\Models\General_model;
use App\Models\Legal_model;
use App\Models\Outlet_model;
use Illuminate\Support\Facades\Validator;


class GetBerkasContactController extends Controller
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
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'id_customer' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }





        $contact = ContactPerson_model::select(
            'contact_person.id',
            'outlet.id_customer',
            'contact_person.id_outlet',
            'nama_lengkap',
            'no_telpon',
            'contact_person.email',
            'jabatan',
            'contact_person.status',
            'users.name'
        )
            ->join('outlet', 'contact_person.id_outlet', '=', 'outlet.id_outlet')
            ->join('users', 'contact_person.ar', '=', 'users.id')
            ->where('outlet.id_customer', $request->id_customer)->get();

        $idOutlet = ContactPerson_model::join('outlet', 'contact_person.id_outlet', '=', 'outlet.id_outlet')->where('outlet.id_customer', $request->id_customer)->distinct()->pluck('contact_person.id_outlet');
        // get data Distributor all data
        $data = [
            'success' => true,
            'message' => 'Get Detail Find Id Customer',
            'Contact' =>  $contact,
            'idOutlet' => $idOutlet

        ];


        return $data;
    }

    public function destroy(Request $request)
    {
        try {
            ContactPerson_model::findOrFail($request->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Success Delete records Detail Contact Person.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
