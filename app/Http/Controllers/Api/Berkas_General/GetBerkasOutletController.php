<?php

namespace App\Http\Controllers\Api\Berkas_General;


use App\Models\Legal_model;
use App\Models\Outlet_model;
use Illuminate\Http\Request;
use App\Models\Account_model;
use App\Models\General_model;
use App\Models\ImagesOutlet_model;
use Illuminate\Support\Facades\DB;
use App\Models\ContactPerson_model;
use App\Http\Controllers\Controller;
use App\Models\DetailDistributor_model;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class GetBerkasOutletController extends Controller
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



        $fullUrl = url('/');

        // Catatan untuk get Detail Generals
        $dataOutlet = Outlet_model::select(
            'outlet.id',
            'id_customer',
            'id_outlet',
            'nama_outlet',
            'outlet_type',
            'address_type',
            'area',
            'alamat',
            'provinsi',
            'kota',
            'kecamatan',
            'kelurahan',
            'kode_pos',
            'latitude',
            'longitude',
            'aplikasi',
            'jumlah_pengambilan',
            'status',
            'remarks',
            'status_generate_qrcode',
            'users.name',
            DB::raw(
                "IF(status_generate_qrcode = 1, CONCAT('$fullUrl', '/qrcode/',id_outlet, '.svg'), NULL) AS qrcode"
            )
        )
            ->join('area', 'outlet.id_area', '=', 'area.id')
            ->join('users', 'outlet.ar', '=', 'users.id')
            ->where('outlet.id_customer', $request->id_customer)
            ->with(['Image' => function ($query) use ($fullUrl) {
                $query->select('images_outlet.id', 'images_outlet.id_outlet', 'images_outlet.nama_foto')
                    ->selectRaw("CONCAT('$fullUrl', '/files/', images_outlet.foto) AS foto")->whereNull('deleted_at');;
            }])->when(false, function ($query) {
                return $query->where('status_generate_qrcode', '=', 1);
            })->get();





        // get data Distributor all data
        $data = [
            'success' => true,
            'message' => 'Get Detail Find Id Customer',
            'Outlet' => $dataOutlet,
        ];


        return $data;
    }

    public function destroy(Request $request)
    {
        try {
            $getOutlet = Outlet_model::find($request->id);
            $getImagesOutlet = ImagesOutlet_model::where('id_outlet', $request->id)->get();

            foreach ($getImagesOutlet as $fileFoto) {
                unlink("files/" . $fileFoto->foto);
            }

            Outlet_model::find($request->id)->delete();
            ImagesOutlet_model::where('id_outlet', $request->id)->delete();
            ContactPerson_model::where('id_outlet', $getOutlet->id_outlet)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Success Delete records Outlet.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }

    public function generate_qrcode(Request $request)
    {
        try {
            $data = Outlet_model::findOrFail($request->id);
            Outlet_model::where("id", $request->id)->update(["status_generate_qrcode" => 1]);
            $qrcode = QrCode::size(400)->generate($data->id_outlet, public_path('qrcode/' . $data->id_outlet . '.svg'));
            return response()->json([
                'success' => true,
                'message' =>  'Generate Qrcode Id Outlet ' . $data->id_outlet . ' berhasil'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
