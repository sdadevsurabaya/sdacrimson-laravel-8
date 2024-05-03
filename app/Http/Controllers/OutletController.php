<?php

namespace App\Http\Controllers;

use App\Models\JNE_model;
use App\Models\Outlet_model;
use App\Models\ContactPerson_model;
use App\Models\ImagesOutlet_model;
use App\Models\General_model;
use App\Models\DrafId_model;
use App\Models\DetailDistributor_model;

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Validator;
use Response;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function show_form(Request $request)
    {
        $id = $request->id;
        // $outlets = DB::table('jne_api')->distinct()->get();
        $getGeneral = General_model::where('id_customer', $id)->first();

        $outlets = DB::table('jne_api')
                    ->select('province_name')
                    ->distinct()
                    ->orderby('province_name', 'asc')
                    ->get();

        $type_outlet = DB::table('type_outlet')
                    ->select('type_outlet')
                    ->distinct()
                    ->orderby('type_outlet', 'asc')
                    ->get();

        $area = DB::table('area')
                    ->select('*')
                    ->distinct()
                    ->orderby('area', 'asc')
                    ->get();

        $brand = DB::table('brand')
                ->select('brand')
                ->distinct()
                ->orderby('brand', 'asc')
                ->get();

        return view('berkas.outlet',compact('id', 'getGeneral', 'outlets', 'type_outlet', 'area', 'brand'));
    }

    public function get_kota(Request $request)
    {
        $province = str_replace('%20',' ',$request->id);
        $city_names = DB::table('jne_api')
                    ->select('city_name')
                    ->distinct()
                    ->orderby('city_name', 'asc')
                    ->where('province_name', $province)
                    ->get();

        echo "<option value='' selected='' disabled=''>-- Pilih Kota --</option>";
        foreach ($city_names as $city_name) {
            echo "<option value='".$city_name->city_name."'>".$city_name->city_name."</option>";
        } ;
    }

    public function get_kota_edit_outlet(Request $request)
    {
        $getDataOutlet = Outlet_model::find($request->id);

        $city_names = DB::table('jne_api')
                    ->select('city_name')
                    ->distinct()
                    ->orderby('city_name', 'asc')
                    ->where('province_name', $getDataOutlet->provinsi)
                    ->get();

        foreach ($city_names as $city_name) {
            echo "<option value='".$city_name->city_name."'". ($city_name->city_name == $getDataOutlet->kota ? 'selected':'' ).">".$city_name->city_name."</option>";
        } ;
    }

    public function get_kecamatan(Request $request)
    {
        $provinsi = str_replace('%20',' ',$request->provinsi);
        $kota = str_replace('%20',' ',$request->kota);

        $district_names = DB::table('jne_api')
                    ->select('district_name')
                    ->distinct()
                    ->orderby('district_name', 'asc')
                    ->where([
                        ['province_name', $provinsi],
                        ['city_name', $kota]
                    ])
                    ->get();

        echo "<option value='' selected='' disabled=''>-- Pilih Kecamatan --</option>";
        foreach ($district_names as $district_name) {
            echo "<option value='".$district_name->district_name."'>".$district_name->district_name."</option>";
        } ;
    }

    public function get_kecamatan_edit_outlet(Request $request)
    {
        $getDataOutlet = Outlet_model::find($request->id);

        $district_names = DB::table('jne_api')
                    ->select('district_name')
                    ->distinct()
                    ->orderby('district_name', 'asc')
                    // ->where('city_name', $getDataOutlet->kota)
                    ->where([
                        ['province_name', $getDataOutlet->provinsi],
                        ['city_name', $getDataOutlet->kota]
                    ])
                    ->get();

        foreach ($district_names as $district_name) {
            echo "<option value='".$district_name->district_name."'". ($district_name->district_name == $getDataOutlet->kecamatan ? 'selected':'' ).">".$district_name->district_name."</option>";
        } ;
    }

    public function get_kelurahan(Request $request)
    {
        $provinsi = str_replace('%20',' ',$request->provinsi);
        $kota = str_replace('%20',' ',$request->kota);
        $kecamatan = str_replace('%20',' ',$request->kecamatan);
        $subdidstrict_names = DB::table('jne_api')
                    ->select('subdidstrict_name')
                    ->distinct()
                    ->orderby('subdidstrict_name', 'asc')
                    ->where([
                        ['province_name', $provinsi],
                        ['city_name', $kota],
                        ['district_name', $kecamatan],
                    ])
                    ->get();

        echo "<option value='' selected='' disabled=''>-- Pilih Kelurahan --</option>";
        foreach ($subdidstrict_names as $subdidstrict_name) {
            echo "<option value='".$subdidstrict_name->subdidstrict_name."'>".$subdidstrict_name->subdidstrict_name."</option>";
        } ;
    }

    public function get_kelurahan_edit_outlet(Request $request)
    {
        $getDataOutlet = Outlet_model::find($request->id);

        $subdidstrict_names = DB::table('jne_api')
                    ->select('subdidstrict_name')
                    ->distinct()
                    ->orderby('subdidstrict_name', 'asc')
                    // ->where('district_name', $getDataOutlet->kecamatan)
                    ->where([
                        ['province_name', $getDataOutlet->provinsi],
                        ['city_name', $getDataOutlet->kota],
                        ['district_name', $getDataOutlet->kecamatan],
                    ])
                    ->get();

        foreach ($subdidstrict_names as $subdidstrict_name) {
            echo "<option value='".$subdidstrict_name->subdidstrict_name."'". ($subdidstrict_name->subdidstrict_name == $getDataOutlet->kelurahan ? 'selected':'' ).">".$subdidstrict_name->subdidstrict_name."</option>";
        } ;
    }

    public function get_kode_pos(Request $request)
    {
        $provinsi = str_replace('%20',' ',$request->provinsi);
        $kota = str_replace('%20',' ',$request->kota);
        $kecamatan = str_replace('%20',' ',$request->kecamatan);
        $kelurahan = str_replace('%20',' ',$request->kelurahan);

        $zip_code = DB::table('jne_api')
                    ->select('*')
                    // ->distinct()
                    // ->orderby('zip_code', 'asc')
                    ->where([
                        ['province_name', $provinsi],
                        ['city_name', $kota],
                        ['district_name', $kecamatan],
                        ['subdidstrict_name', $kelurahan]
                    ])
                    ->get();

        echo str_replace(' ','',$zip_code[0]->zip_code);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate_id_outlet(Request $request)
    {
        $covert_huruf_besar = strtoupper($request->nama_outlet);
        $id_customer = $request->id_customer;
        $huruf = substr($request->kota,0,3);

        $CountData = Outlet_model::where('id_customer', $id_customer)->count();

        if ($CountData > 0 ) {
            $data = Outlet_model::where('id_customer', $id_customer)
                            ->orderBy('id','desc')
                            ->get(['outlet.id_outlet as id_outlet']);

            $urutan = substr($data[0]->id_outlet,-3);
            $urutan++;
        } else {
            $urutan = 0;
            $urutan++;
        }

        $id_outlet = $id_customer ."-". $huruf ."-". sprintf("%03s", $urutan);

        // DrafId_model::create([
        //     'id_customer' => $id_customer,
        //     'id_outlet'   => $id_outlet
        // ]);

        $DrafId = DrafId_model::where('id_customer', $id_customer)->orderby('id', 'desc')->first();

        $data = DrafId_model::find($DrafId->id);
        $data->id_outlet = $id_outlet;
        $data->save();

        return response()->json(['success'=>$id_outlet]);

    }

    public function generate_id_outlet_berkas(Request $request)
    {
        $covert_huruf_besar = strtoupper($request->nama_usaha);
        $id_customer = $request->id_general;
        $huruf = substr($request->kota,0,3);

        $CountData = DrafId_model::where('id_customer', $id_customer)->count();

        if ($CountData > 0 ) {
            $data = DrafId_model::where('id_customer', $id_customer)
                            ->orderBy('id','desc')
                            ->get(['draft_id.id_outlet as id_outlet']);

            $urutan = substr($data[0]->id_outlet,-3);
            $urutan++;
        } else {
            $urutan = 0;
            $urutan++;
        }

        $id_outlet = $id_customer ."-". $huruf ."-". sprintf("%03s", $urutan);


        DrafId_model::create([
            'id_customer' => $id_customer,
            'id_outlet'   => $id_outlet,
            'nama_usaha'  => $covert_huruf_besar,
            'alamat_kantor' => $request->alamat_kantor,
            'nama_lengkap' => $request->nama_lengkap,
            'mobile_phone' => $request->mobile_phone,
            'email'   => $request->email
        ]);

        return response()->json(['success'=>$id_outlet]);

    }

    public function get_distributor_draft_id(Request $request)
    {
        // $province = str_replace('%20',' ',$request->id);
        $getDataIdOutletDraftIds = DB::table('draft_id')
                    ->select('*')
                    ->where('id_customer', $request->id)
                    ->get();

        echo "<option value='' selected='' disabled=''>-- Pilih ID Outlet --</option>";
        foreach ($getDataIdOutletDraftIds as $getDataIdOutletDraftId) {
            echo "<option value='".$getDataIdOutletDraftId->id_outlet."'>".$getDataIdOutletDraftId->id_outlet." | ".$getDataIdOutletDraftId->nama_usaha."</option>";
        } ;
    }

    public function get_distributor_outlet(Request $request)
    {
        // $province = str_replace('%20',' ',$request->id);
        $getDataIdOutlets = DB::table('outlet')
                    ->select('*')
                    ->where('id_customer', $request->id)
                    ->get();

        echo "<option value='' selected='' disabled=''>-- Pilih ID Outlet --</option>";
        foreach ($getDataIdOutlets as $getDataIdOutlet) {
            echo "<option value='".$getDataIdOutlet->id_outlet."'>".$getDataIdOutlet->id_outlet." | ".$getDataIdOutlet->nama_outlet."</option>";
        } ;
    }

    public function show_draf_id(Request $request)
    {
        // $id = $request->id;

        $DrafId = DrafId_model::orderby('id', 'desc')->first();

        return response()->json([
            'success' => true,
            'data'    => $DrafId
        ]);
    }

    public function show_data_general(Request $request)
    {
        // $id = $request->id;

        $DataGeneral = General_model::orderby('id', 'desc')->first();

        return response()->json([
            'success' => true,
            'data'    => $DataGeneral
        ]);
    }

    public function store(Request $request)
    {
        if ($request->to_data == "localStorage") {
            $validator = Validator::make($request->all(), [
                //
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'id_customer'   => 'required',
                'outlet_type'   => 'required|not_in:0',
                'address_type'  => 'required|not_in:0',
                // 'area'       => 'required|not_in:0',
                'alamat'        => 'required',
                'nama_lengkap'  => 'required',
                'no_telpon'     => 'required',
                // 'email'         => 'required|email',
                'jabatan'       => 'required',
                'provinsi'      => 'required',
                'kota'          => 'required',
                'kecamatan'     => 'required',
                'kelurahan'     => 'required',
                'kode_pos'      => 'required',
                'latitude'      => 'required',
                'longitude'     => 'required',
                'member_image'  => 'required',
                'namafoto'      => 'required',
                // 'brand'         => 'required',
                'status'        => 'required',
                'remarks'       => 'required',
                'ar'            => 'required',
                'created_date'  => 'required',
            ]);
        }

        $covert_huruf_besar = strtoupper($request->nama_outlet);

        if ($request->to_data == "localStorage") {
            //$getId = General_model::where('id_customer_draf', $request->id_customer)->orderBy('id_customer_draf','desc')->get();

            $getId = DB::select('select * from general_informations where id_customer_draf = "'.$request->id_customer.'"');
            
            // dd($getId);

            if ($getId) {
                $id_customer = $getId[0]->id_customer;
            } else {
                $id_customer = $request->id_customer;
            }

        } else {
            if ($request->id_customer) {
                $getId = General_model::where('id_customer', $request->id_customer)->get();
            } else {
                $getId = General_model::orderBy('id','desc')->get();
            }
            $id_customer = $getId[0]->id_customer;
        }

        // dd($id_customer);
        // $id_customer = $request->id_customer;

        $huruf = substr($request->kota,0,3);

        $CountData = Outlet_model::where('id_customer', $id_customer)->count();

        if ($CountData > 0 ) {
            $data = Outlet_model::where('id_customer', $id_customer)
                            ->orderBy('id','desc')
                            ->get(['outlet.id_outlet as id_outlet']);

            $urutan = substr($data[0]->id_outlet,-3);
            $urutan++;
        } else {
            $urutan = 0;
            $urutan++;
        }

        $id_outlet = $id_customer ."-". $huruf ."-". sprintf("%03s", $urutan);

        if ($validator->passes()) {

            // $files = [];
            // // $path = "public/files";
            // if ($request->hasfile('member_image')) {
            //     foreach ($request->file('member_image') as $file) {
            //         $name = time() . rand(1, 100) . '.' . $file->extension();
            //         $file->move(public_path('files'), $name);
            //         $files[] = $name;
            //     }
            // }

            $CreateOutlet = Outlet_model::create([
                'id_outlet' => $id_outlet,
                'id_customer' => $id_customer,
                'nama_outlet' => $covert_huruf_besar,
                'outlet_type' => $request->outlet_type,
                'address_type' => implode(",",$request->address_type),
                'id_area' => $request->area,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'kode_pos' => $request->kode_pos,
                'lat' => $request->latitude,
                'long' => $request->longitude,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                // 'foto_outlet' => implode(",",$files),
                // 'nama_foto' => implode(",",$request->namafoto),
                // 'brand' => implode(",",$request->brand),
                'aplikasi' => $request->aplikasi,
                'jumlah_pengambilan' => $request->jumlah_pengambilan,
                'status' => $request->status,
                'remarks' => $request->remarks,
                'ar' => $request->ar,
                'status_generate_qrcode' => 0,
                'created_date' => $request->created_date,
                'created_by' => $request->ar,
                // 'update_date' => "null",
                // 'update_time' => "null",
                // 'update_by' => "null",
            ]);

            $images = [];
            $name_images =[];
            // $path = "public/files";
            if ($request->to_data == "localStorage") {
                // if ($request->hasfile('member_image')) {
                    // $files = $request->file('member_image');
                    // foreach ($request->foto as $file) {
                    //     $extension = explode('/', mime_content_type($file))[1];

                    //     $name = time() . rand(1, 100) . '.' . $extension;
                    //     $images[] = $name;


                    //     Image::make($file)->resize(850, null, function ($constraint) {
                    //         $constraint->aspectRatio();
                    //     })->save(public_path('files/' . $name));

                    //     foreach ($request->nama_foto as $name_image) {
                    //         $name_images[] = $name_image;
                    //     }

                    //     $ImagesOutlet = new ImagesOutlet_model();

                    //     for ($i=0; $i < count($images); $i++) {
                    //         $ImagesOutlet->id_outlet = $CreateOutlet->id;
                    //         $ImagesOutlet->foto = $images[$i];
                    //         $ImagesOutlet->nama_foto =  $name_images[$i];
                    //         $ImagesOutlet->save();
                    //     }
                    // }

                    // $DetailDistributor = DetailDistributor_model::where('id_outlet', $request->id_outlet)->orderby('id', 'desc')->first();
                    DetailDistributor_model::where('id_outlet', $request->id_outlet)->update(['id_outlet' => $id_outlet]);
                // }
            } else {
                if ($request->hasfile('member_image')) {
                    // $files = $request->file('member_image');
                    foreach ($request->file('member_image') as $file) {
                        $name = time() . rand(1, 100) . '.' . $file->extension();
                        $images[] = $name;

                        // $file->move(public_path('files'), $name);
                        // dd($request->file('member_image'));
                        // $img = Image::make($file);
                        // $img->resize(150, null);
                        // $img->save(public_path('files/' . $name));
                        // $size = filesize($file);
                        // dd($size);
                        Image::make($file)->resize(850, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save(public_path('files/' . $name));

                        foreach ($request->namafoto as $name_image) {
                            $name_images[] = $name_image;
                        }

                        $ImagesOutlet = new ImagesOutlet_model();

                        for ($i=0; $i < count($images); $i++) {
                            $ImagesOutlet->id_outlet = $CreateOutlet->id;
                            $ImagesOutlet->foto = $images[$i];
                            $ImagesOutlet->nama_foto =  $name_images[$i];
                            $ImagesOutlet->save();
                        }
                    }
                }
            }

            $CreateContactPerson = ContactPerson_model::create([
                'id_outlet' => $id_outlet,
                'nama_lengkap' => $request->nama_lengkap,
                'no_telpon' => $request->no_telpon,
                'email' => $request->email,
                'jabatan' => $request->jabatan,
                'status' => "Aktif",
                'ar' => $request->ar,
                'created_date' => $request->created_date,
                'created_by' => $request->ar,
            ]);

            return response()->json(['success'=>'Added new records Outlet.']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $outlet = Outlet_model::find($id);

        return response()->json([
            'success' => true,
            'data'    => $outlet
        ]);
    }

    public function get_images_outlet($id)
    {
        $images_outlet = ImagesOutlet_model::where('id_outlet', $id)->get();
        // dump($images_outlet);

        return response()->json([
            'success' => true,
            'dataImages'    => $images_outlet
        ]);
    }


    public function deleteFoto($id)
    {
        $getImagesOutlet = ImagesOutlet_model::find($id);

        unlink("files/".$getImagesOutlet->foto);

        ImagesOutlet_model::find($id)->delete();

        return response()->json(['success'=>'Success Delete records Images Outlet.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_outlet_edit_outlet'         => 'required',
            'id_customer_edit_outlet'       => 'required',
            'outlet_type_edit_outlet'       => 'required',
            'address_type_edit_outlet'      => 'required',
            // 'alamat_edit_outlet'         => 'required',
            // 'provinsi_edit_outlet'       => 'required',
            // 'kota_edit_outlet'           => 'required',
            // 'kecamatan_edit_outlet'      => 'required',
            // 'kelurahan_edit_outlet'      => 'required',
            // 'kode_pos_edit_outlet'       => 'required',
            // 'latitude_edit_outlet'       => 'required',
            // 'longitude_edit_outlet'      => 'required',
            // 'member_image_edit_outlet'   => 'required',
            // 'namafoto_edit_outlet'       => 'required',
            // 'brand_edit_outlet'          => 'required',
            // 'status_outlet_edit_outlet'  => 'required',
            // 'remarks_edit_outlet'        => 'required',
            // 'created_date_edit_outlet'   => 'required',
            // 'created_by_edit_outlet'     => 'required',
            // 'update_date_edit_outlet'    => 'required',
            // 'update_time_edit_outlet'    => 'required',
            // 'update_by_edit_outlet'      => 'required',
        ]);

        // $f = [];
        // foreach ($request->file('member_image_edit_outlet') as $file) {

        //     $name = time() . rand(1, 100) . '.' . $file->extension();
        //     array_push($f,$name);
        // }

        // $types = count($request->file('member_image_edit_outlet'));

        // return response()->json(['success'=>$types]);


        if ($validator->passes()) {
            $covert_huruf_besar = strtoupper($request->nama_outlet_edit_outlet);
            $data = Outlet_model::find($request->id_edit_outlet);
            $data->id_outlet = $request->id_outlet_edit_outlet;
            $data->id_customer = $request->id_customer_edit_outlet;
            $data->nama_outlet = $covert_huruf_besar;
            $data->outlet_type = $request->outlet_type_edit_outlet;
            $data->address_type = implode(",",$request->address_type_edit_outlet);
            $data->id_area = $request->area_edit_outlet;
            $data->alamat = $request->alamat_edit_outlet;
            $data->provinsi = $request->provinsi_edit_outlet;
            $data->kota = $request->kota_edit_outlet;
            $data->kecamatan = $request->kecamatan_edit_outlet;
            $data->kelurahan = $request->kelurahan_edit_outlet;
            $data->kode_pos = $request->kode_pos_edit_outlet;
            $data->latitude = $request->latitude_edit_outlet;
            $data->longitude = $request->longitude_edit_outlet;
            // $data->foto_outlet = implode(",",$files);
            // $data->nama_foto = implode(",",$request->namafoto_edit_outlet);
            // $data->brand = implode(",",$request->brand_edit_outlet);
            $data->aplikasi = $request->aplikasi_edit_outlet;
            $data->jumlah_pengambilan = $request->jumlah_pengambilan_edit_outlet;
            $data->status = $request->status_outlet_edit_outlet;
            $data->remarks = $request->remarks_edit_outlet;
            $data->ar = $request->created_by_edit_outlet;
            $data->status_generate_qrcode = $request->status_generate_qrcode_outlet;
            $data->created_date = $request->created_date_edit_outlet;
            $data->created_by = $request->created_by_edit_outlet;
            $data->update_date = $request->update_date_edit_outlet;
            $data->update_time = $request->update_time_edit_outlet;
            $data->update_by = $request->update_by_edit_outlet;
            $data->save();


            $images = [];
            $name_images = [];
            $dataNameImages = [];
            $dataBerubah = [];
            $arrayImages = [];
            // $path = "public/files";
            if ($request->hasfile('member_image_edit_outlet')) {
                // $files = $request->file('member_image_edit_outlet');
                // $getImages = ImagesOutlet_model::where();
                foreach ($request->file('member_image_edit_outlet') as $key1 => $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $images[$key1] = $name;

                    // $file->move(public_path('files'), $name);

                    Image::make($file)->resize(850, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('files/' . $name));

                    foreach ($request->input('namafoto_edit_outlet') as $key2 => $name_image) {
                        $name_images[] = $name_image;
                    }

                    $GetImages = ImagesOutlet_model::where('id_outlet', $request->id_edit_outlet)->get();

                    foreach ($GetImages as $key3 => $data) {
                        $dataImages[] = $data->foto;
                        $arrayImages[] = $key3;
                    }

                    if ($key1 == count($GetImages)) {
                        // dd("true");
                        $ImagesOutlet = new ImagesOutlet_model();

                        for ($i=0; $i < count($images); $i++) {
                            $ImagesOutlet->id_outlet = $request->id_edit_outlet;
                            $ImagesOutlet->foto = $images[$key1];
                            $ImagesOutlet->nama_foto =  $name_images[$key1];
                            $ImagesOutlet->save();
                        }
                    } else {
                        // dd("false");
                        if ($key1 == $arrayImages[$key1]) {
                            // dd("true");
                            $GetIdImages = ImagesOutlet_model::where('foto',  $dataImages[$key1])->first();

                            unlink("files/".$GetIdImages->foto);

                            $ImagesOutletEdit = ImagesOutlet_model::find($GetIdImages->id);
                            $ImagesOutletEdit->id_outlet = $request->id_edit_outlet;
                            $ImagesOutletEdit->foto = $images[$key1];
                            $ImagesOutletEdit->nama_foto = $name_images[$key1];
                            $ImagesOutletEdit->save();

                            // dd($GetIdImages->id);
                        }

                    }
                }

            } else {
                $GetImages = ImagesOutlet_model::where('id_outlet', $request->id_edit_outlet)->get();

                foreach ($GetImages as $key3 => $data) {
                    $dataNameImages[] = $data->nama_foto;
                    $getDataIdImages[] = $data->id;
                    $arrayImages[] = $key3;
                }

                foreach ($request->input('namafoto_edit_outlet') as $key2 => $name_image) {
                    $name_images[] = $name_image;
                }

                if ($dataNameImages != $name_images) {
                    $dataBerubah = array_diff($dataNameImages,$name_images);
                    $getIndexArray = array_keys($dataBerubah);
                    $getValueArray = $getIndexArray[0];
                    $dataIdImages = $GetImages[$getValueArray]->id;
                    $namaImagesNew = $name_images[$getValueArray];

                    ImagesOutlet_model::where('id',$dataIdImages)->update(['nama_foto'=>$namaImagesNew]);

                } else {
                    // dd("true");
                }
            }

            return response()->json(['success'=>'Added edit records Outlet.']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getOutlet = Outlet_model::find($id);
        $getImagesOutlet = ImagesOutlet_model::where('id_outlet', $id)->get();

        foreach ($getImagesOutlet as $fileFoto) {
            unlink("files/".$fileFoto->foto);
        }

        Outlet_model::find($id)->delete();
        ImagesOutlet_model::where('id_outlet', $id)->delete();
        ContactPerson_model::where('id_outlet', $getOutlet->id_outlet)->delete();

        return response()->json(['success'=>'Success Delete records Outlet.']);
    }
}
