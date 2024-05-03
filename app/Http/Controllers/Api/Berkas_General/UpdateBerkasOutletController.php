<?php

namespace App\Http\Controllers\Api\Berkas_General;



use JWTAuth;
use App\Models\Outlet_model;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ImagesOutlet_model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;


class UpdateBerkasOutletController extends Controller
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
            $validator = Validator::make($request->all(), [
                'files.*' => 'image|mimes:jpeg,png,jpg,gif',
                // 'nama_foto' => 'required',
                'id'   => 'required',
                'outlet_type'   => 'required|not_in:0',
                'address_type'  => 'required|not_in:0',
                'alamat'        => 'required',
                'provinsi'      => 'required',
                'kota'          => 'required',
                'kecamatan'     => 'required',
                'kelurahan'     => 'required',
                'latitude'      => 'required',
                'longitude'     => 'required',
                'aplikasi'      => 'required',
                'status'        => 'required'
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            $now = Carbon::now();
            $createdDate = $now->format('Y-m-d');
            $formattedTime = $now->format('H:i:s');

            $user = JWTAuth::parseToken()->authenticate();

            //get role user login
            $userId = $user->id;


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
            // dd($request->address_type);

            $dataarrayId = $request->id_foto2;
            $namaFotoRequest = $request->nama_foto2;
            $covert_huruf_besar = strtoupper($request->nama_outlet);
            $data = Outlet_model::findOrFail($request->id);

            // sementara dulu nunggu request fix mobile
            // $imageSh = ImagesOutlet_model::where('id_outlet', $data->id)->pluck('id');
            $NameFotoDb = ImagesOutlet_model::where('id_outlet', $data->id)->whereNull('deleted_at')->pluck('nama_foto')->toArray();
            // $collection1 = new Collection($dataarrayId);
            // $collection2 = new Collection($imageSh);

            // $difference = $collection1->diff($collection2);
            if (!empty($dataarrayId)) {
                foreach ($dataarrayId as $index => $key) {
                    $newValue = $namaFotoRequest[$index];
                    $oldValue = $NameFotoDb[$index];

                    if ($newValue !== $oldValue) {
                        // Lakukan pembaruan data dengan where id_imagku dari $key
                        ImagesOutlet_model::where('id', $key)->update(['nama_foto' => $newValue]);
                    }
                }
            }

            // dd($NameFotoDb);
            // if (!$imageSh->isEmpty()) {
            //     $imageShArray = $imageSh->toArray();
            //     // Lakukan tindakan dengan $imageShArray

            // } else {
            //     // dd('ok');
            //     $imageShArray = [];
            // }
            // $difference = array_diff($imageShArray, $dataarrayId);
            // dd($difference);

            //end

            $data->nama_outlet = $covert_huruf_besar;
            $data->outlet_type = $request->outlet_type;
            $data->address_type = implode(",", $request->address_type);
            $data->alamat = $request->alamat;
            $data->provinsi = $request->provinsi;
            $data->kota = $request->kota;
            $data->kecamatan = $request->kecamatan;
            $data->kelurahan = $request->kelurahan;
            $data->kode_pos = $request->kode_pos;
            $data->latitude = $request->latitude;
            $data->longitude = $request->longitude;
            $data->aplikasi = $request->aplikasi;
            $data->remarks = $request->remarks;
            $data->status = $request->status;
            $data->id_area = $getArea;
            $data->jumlah_pengambilan = $request->jumlah_pengambilan;

            $data->update_date = $createdDate;
            $data->update_time = $formattedTime;
            $data->update_by = $userId;
            $data->save();


            //sementara dulu tidak jadi 
            // $images = [];
            // $name_images = [];
            // $dataNameImages = [];
            // $dataBerubah = [];
            // $arrayImages = [];
            // // $path = "public/files";
            // if ($request->hasfile('files')) {
            //     // $files = $request->file('files');
            //     // $getImages = ImagesOutlet_model::where();
            //     // $GetIdImages = ImagesOutlet_model::where('id_outlet', $request->id)->get();
            //     // // dd($GetIdImages);
            //     // if (!$GetIdImages->isEmpty()) {
            //     //     foreach ($GetIdImages as $key => $image) {
            //     //         // Hapus file dari sistem file
            //     //         unlink("files/" . $image->foto);

            //     //         // Hapus data dari database
            //     //         $image->delete();
            //     //     }
            //     // }
            //     foreach ($request->file('files') as $key1 => $file) {
            //         $name = time() . rand(
            //             1,
            //             100
            //         ) . '.' . $file->extension();
            //         $images[$key1] = $name;

            //         // $file->move(public_path('files'), $name);

            //         Image::make($file)->resize(850, null, function ($constraint) {
            //             $constraint->aspectRatio();
            //         })->save(public_path('files/' . $name));

            //         foreach ($request->input('nama_foto') as $key2 => $name_image) {
            //             $name_images[] = $name_image;
            //         }

            //         $GetImages = ImagesOutlet_model::where('id_outlet', $request->id)->get();

            //         foreach ($GetImages as $key3 => $data) {
            //             $dataImages[] = $data->foto;
            //             $arrayImages[] = $key3;
            //         }

            //         if ($key1 == count($GetImages)) {
            //             // dd("true");
            //             $ImagesOutlet = new ImagesOutlet_model();

            //             for ($i = 0; $i < count($images); $i++) {
            //                 $ImagesOutlet->id_outlet = $request->id;
            //                 $ImagesOutlet->foto = $images[$key1];
            //                 $ImagesOutlet->nama_foto =  $name_images[$key1];
            //                 $ImagesOutlet->save();
            //             }
            //         } else {
            //             // dd("false");
            //             if ($key1 == $arrayImages[$key1]) {
            //                 // dd("true");
            //                 $GetIdImages = ImagesOutlet_model::where('foto',  $dataImages[$key1])->first();

            //                 unlink("files/" . $GetIdImages->foto);

            //                 $ImagesOutletEdit = ImagesOutlet_model::find($GetIdImages->id);
            //                 $ImagesOutletEdit->id_outlet = $request->id;
            //                 $ImagesOutletEdit->foto = $images[$key1];
            //                 $ImagesOutletEdit->nama_foto = $name_images[$key1];
            //                 $ImagesOutletEdit->save();

            //                 // dd($GetIdImages->id);
            //             }
            //         }
            //     }
            // }

            //end 

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
                        'id_outlet' => $request->id,
                    ]);
                }
            }

            $data = [
                'success' => true,
                'message' => 'Update Detail Outlet Success',
                // 'data' => $editLegal

            ];


            return $data;
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }

    public function destroy(Request $request)
    {
        try {
            //valid credential
            $validator = Validator::make($request->all(), [
                'token' => 'required',
            ]);

            //Send failed response if request is not valid
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            $getImagesOutlet = ImagesOutlet_model::where('id', $request->id)->first();



            // unlink("files/" . $getImagesOutlet->foto);

            $filePath = public_path("files/" . $getImagesOutlet->foto);
            // dd($filePath);
            if (file_exists($filePath)) {
                unlink($filePath);
            } else {
                // dd('kosong');
                return response()->json([
                    'success' => false,
                    'message' => 'File Image not found. ',
                ], 404);
            }

            $now = Carbon::now();

            $user = JWTAuth::parseToken()->authenticate();

            //get role user login
            $userId = $user->id;

            $dataUpdate = [
                'deleted_at' => $now,
                'ar' => $userId
            ];

            ImagesOutlet_model::where('id', $request->id)->update($dataUpdate);

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
}
