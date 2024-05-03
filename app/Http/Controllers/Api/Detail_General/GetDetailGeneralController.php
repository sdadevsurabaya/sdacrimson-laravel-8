<?php

namespace App\Http\Controllers\Api\Detail_General;


use App\Models\Legal_model;
use App\Models\Outlet_model;
use Illuminate\Http\Request;
use App\Models\Account_model;
use App\Models\General_model;
use Illuminate\Support\Facades\DB;
use App\Models\ContactPerson_model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class GetDetailGeneralController extends Controller
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

        $dataGeneral = General_model::select(
            'id_customer',
            'type_usaha',
            'nama_usaha',
            'nama_lengkap',
            'alamat_kantor',
            'jabatan',
            'telepon',
            'mobile_phone',
            'general_informations.email',
            'web_site',
            'no_npwp',
            'nama_npwp',
            'alamat_npwp',
            'nik',
            'users.name',
            'created_date'

        )
            ->join('users', 'general_informations.ar', '=', 'users.id')->where('id_customer', $request->id_customer)->get();


        $fullUrl = url('/');


        // Catatan untuk get Detail Generals
        $dataOutlet = Outlet_model::select(
            'outlet.id',
            'id_outlet',
            'id_customer',
            'nama_outlet',
            'outlet_type',
            'address_type',
            'alamat',
            'provinsi',
            'kota',
            'kecamatan',
            'kelurahan',
            'kode_pos',
            'latitude',
            'longitude',
            'aplikasi',
            'status',
            'remarks',
            'users.name',
            'jumlah_pengambilan',
            DB::raw(
                "IF(status_generate_qrcode = 1, CONCAT('$fullUrl', '/qrcode/',id_outlet, '.svg'), NULL) AS qrcode"
            )
        )
            ->selectRaw("CONCAT(area.area, '/', area.nama_area) AS area")->with(['Image' => function ($query) use ($fullUrl) {
                $query->select('images_outlet.id_outlet', 'images_outlet.nama_foto')
                    ->selectRaw("CONCAT('$fullUrl', '/files/', images_outlet.foto) AS foto");
            }])
            ->with(['Distributor' => function ($query) {
                $query->select('detail_customers.id_outlet', 'customers.id_cust', 'customers.nama_cust', 'detail_customers.brand')
                    ->join('customers', 'detail_customers.id_cust', '=', 'customers.id_cust');
            }])->where('id_customer', $request->id_customer)
            ->join('area', 'outlet.id_area', '=', 'area.id')
            ->join('users', 'outlet.ar', '=', 'users.id')
            ->when(false, function ($query) {
                return $query->where('status_generate_qrcode', '=', 1);
            })->get();

        $legal = Legal_model::select('id_customer', 'tahun_berdiri', 'no_siup', 'no_tdp', 'status', 'remarks', 'users.name')
            ->where('id_customer', $request->id_customer)
            ->join('users', 'legal.ar', '=', 'users.id')->get();

        $contact = ContactPerson_model::select(
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

        $account = Account_model::select(
            'outlet.id_customer',
            'payment_trems',
            'id_price',
            'credit_limit',
            'max_nota',
            'bank',
            'atas_nama',
            'no_rek',
            'cabang',
            'account.remarks',
            'account.status',
            'users.name'
        )
            ->join('outlet', 'account.id_customer', '=', 'outlet.id_customer')
            ->join('users', 'account.ar', '=', 'users.id')
            ->groupBy('account.id')
            ->where('account.id_customer', $request->id_customer)->get();





        // dd($legals);


        // get data Distributor all data
        $data = [
            'success' => true,
            'message' => 'Get Detail Find Id',
            'id_outlet' => '',
            'General' => $dataGeneral,
            'Legal' =>  $legal,
            'Contact' =>  $contact,
            'Account' =>  $account,
            'Outlet' => $dataOutlet,
        ];


        return $data;
    }
}
