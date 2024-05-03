<?php

namespace App\Http\Controllers\Api\Outlet;

use JWTAuth;
use App\Models\Outlet_model;
use Illuminate\Http\Request;
use App\Models\General_model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\ContactPerson_model;
use App\Models\JNE_model;
use Intervention\Image\Facades\Image;
use App\Models\ImagesOutlet_model;
use App\Http\Controllers\Controller;
use App\Models\Attachment_model;

class PostOutletController extends Controller
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

            $validator = Validator::make($request->all(), [
                'files.*' => 'image|mimes:jpeg,png,jpg,gif',
                // 'nama_foto' => 'required',
                'id_customer'   => 'required',
                'outlet_type'   => 'required|not_in:0',
                'address_type'  => 'required|not_in:0',
                'alamat'        => 'required',
                'nama_lengkap'  => 'required',
                'no_telpon'     => 'required',
                'jabatan'       => 'required',
                'provinsi'      => 'required',
                'kota'          => 'required',
                'kecamatan'     => 'required',
                'kelurahan'     => 'required',
                'latitude'      => 'required',
                'longitude'     => 'required',
                'aplikasi'     => 'required',
            ]);



            if ($validator->fails()) {
                return response()->json([
                    'success' => $validator->errors(),
                ], 422);
            }



            $covertNameOutlet = strtoupper($request->nama_outlet);

            $user = JWTAuth::parseToken()->authenticate();

            //get role user login
            $userId = $user->id;



            if ($request->id_customer) {
                $getId = General_model::where('id_customer', $request->id_customer)->get();
                $id_customer = $getId[0]->id_customer;
            } else {
                //get id_customer which is being created by the logged in user
                $getId = General_model::where('ar', $userId)->orderBy('created_at', 'desc')->first();
                $id_customer = $getId->id_customer;
            }



            // $id_customer = $request->id_customer;

            $huruf = substr($request->kota, 0, 3);

            $CountData = Outlet_model::where('id_customer', $id_customer)->count();

            if ($CountData > 0) {
                $data = Outlet_model::where('id_customer', $id_customer)
                    ->orderBy('id', 'desc')
                    ->get(['outlet.id_outlet as id_outlet']);

                $urutan = substr($data[0]->id_outlet, -3);
                $urutan++;
            } else {
                $urutan = 0;
                $urutan++;
            }

            $id_outlet = $id_customer . "-" . $huruf . "-" . sprintf("%03s", $urutan);
            // dd(implode(",", $request->address_type));


            $get_Area = DB::table('area')
                ->select('*')
                ->where([
                    ['detail', $request->kota]
                ])
                ->get();
            // dd($get_Area);
            if ($get_Area->isEmpty()) {
                $getArea = '';
            } else {
                $getArea = $get_Area[0]->id;
            }




            $now = Carbon::now();
            $createdDate = $now->format('Y-m-d');

            $KodePost = JNE_model::select('zip_code')->where('district_name', $request->kecamatan)->where('subdidstrict_name', $request->kelurahan)->first();


            $CreateOutlet = Outlet_model::create([
                'id_outlet' => $id_outlet,
                'id_customer' => $request->id_customer,
                'nama_outlet' => $covertNameOutlet,
                'outlet_type' => $request->outlet_type,
                'address_type' => implode(",", $request->address_type),
                'id_area' => $getArea,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'kode_pos' => $KodePost->zip_code,
                'lat' => $request->latitude,
                'long' => $request->longitude,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'aplikasi' => $request->aplikasi,
                'jumlah_pengambilan' => $request->jumlah_pengambilan,
                'status' => 'Aktif',
                'remarks' => $request->remarks,
                'ar' => $userId,
                'status_generate_qrcode' => 0,
                'created_date' => $createdDate,
                'created_by' => $userId,
            ]);


            $CreateContactPerson = ContactPerson_model::create([
                'id_outlet'     => $CreateOutlet->id_outlet,
                'nama_lengkap'  => $request->nama_lengkap,
                'no_telpon'     => $request->no_telpon,
                'email'         => $request->email,
                'jabatan'       => $request->jabatan,
                'status'        => 'Aktif',
                'ar'            => $userId,
                'created_date'  => $createdDate,
                'created_by'    => $userId,
            ]);


            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $index => $image) {
                    $imageName = time()  . rand(1, 100) . '.' . $image->getClientOriginalExtension();

                    $resizedImage = Image::make($image)->resize(850, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $resizedImage->save(public_path('files/' . $imageName), 90);

                    $CreateimageOutlet = ImagesOutlet_model::create([
                        'nama_foto' => $request->nama_foto[$index],
                        'foto' => $imageName,
                        'id_outlet' => $CreateOutlet->id,
                    ]);
                }
            }



            // $data = [
            //     'CreateContactPerson' => $CreateContactPerson->toArray(),
            //     'CreateOutlet' => $CreateOutlet->toArray(),
            //     'CreateimageOutlet' => $CreateimageOutlet->toArray(),
            // ];

            $data = [
                'success' => true,
                'message' => 'Outlet created successfully.',
                'id_outlet' => $CreateOutlet->id_outlet,
                'CreateOutlet' => $CreateOutlet,
                'CreateContactPerson' => $CreateContactPerson,
                'CreateimageOutlet' => $CreateimageOutlet,

            ];


            return $data;
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }


    public function singlePhoto(Request $request)
    {



        $request->validate([
            'files' => 'required|image|mimes:jpeg,png,jpg,gif',
            'nama_files' => 'required|string|max:255',
        ]);

        $name = $request->input('nama_files');

        // Simpan gambar menggunakan store()
        $image = $request->file('files');
        $imageName = time()  . rand(1, 100) . '.' . $image->getClientOriginalExtension();

        $resizedImage = Image::make($image)->resize(850, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $resizedImage->save(public_path('files/' . $imageName), 90);

        $team = Attachment_model::create([
            'nama_files' => $name,
            'files' => $imageName,
        ]);

        $team->save();

        $response = [
            'success' => true,
            'message' => 'Data berhasil ditambahkan.',
            'data' => $team,
        ];

        return $response;
    }
}
