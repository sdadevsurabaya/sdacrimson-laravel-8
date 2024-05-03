<?php

namespace App\Http\Controllers\Api\Outlet;

use App\Models\Member_address_model;
use App\Http\Resources\MemberAddressResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Outlet_model;

class PostImageController extends Controller
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

    public function scan(Request $request)
    {
        dd("tessss");
    }

    public function store(Request $request)
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

        if ($validator->passes()) {
            $findoutlet = DB::select("select * from outlet where id=" . $request->id_edit_outlet);
            $outlet = $findoutlet[0];

            $photooutlet = explode(',', $outlet->foto_outlet);
            // dd("tes");
            // $count = $request->file('member_image_edit_outlet');
            // $count = $_FILES['member_image_edit_outlet'];
            $count = $_FILES["member_image_edit_outlet"]["tmp_name"];
            return response()->json(['success' => $count]);

            // $files = [];
            // $path = "public/files";
            // if ($request->hasfile('member_image_edit_outlet')) {
            //     // dump("ada value");
            //     foreach ($request->file('member_image_edit_outlet') as $file) {
            //         $name = time() . rand(1, 100) . '.' . $file->extension();
            //         $file->move(public_path('files'), $name);
            //         $files[] = $name;
            //         // dd($name);
            //     }
            //     //ditambahkan
            //     $finalphoto = array_merge($photooutlet, $files);
            // } else {
            //     $finalphoto = $files;
            // }

            // $data = Outlet_model::find($request->id_edit_outlet);
            // $data->id_outlet = $request->id_outlet_edit_outlet;
            // $data->id_customer = $request->id_customer_edit_outlet;
            // $data->outlet_type = $request->outlet_type_edit_outlet;
            // $data->address_type = implode(",", $request->address_type_edit_outlet);
            // $data->alamat = $request->alamat_edit_outlet;
            // $data->provinsi = $request->provinsi_edit_outlet;
            // $data->kota = $request->kota_edit_outlet;
            // $data->kecamatan = $request->kecamatan_edit_outlet;
            // $data->kelurahan = $request->kelurahan_edit_outlet;
            // $data->kode_pos = $request->kode_pos_edit_outlet;
            // $data->latitude = $request->latitude_edit_outlet;
            // $data->longitude = $request->longitude_edit_outlet;
            // // $data->foto_outlet = implode(",",$files);

            // $data->foto_outlet = implode(",", $finalphoto);


            // $data->nama_foto = implode(",", $request->namafoto_edit_outlet);
            // $data->brand = implode(",", $request->brand_edit_outlet);
            // $data->status = $request->status_outlet_edit_outlet;
            // $data->remarks = $request->remarks_edit_outlet;
            // $data->ar = $request->created_by_edit_outlet;
            // $data->created_date = $request->created_date_edit_outlet;
            // $data->created_by = $request->update_by_edit_outlet;
            // $data->update_date = $request->update_date_edit_outlet;
            // $data->update_time = $request->update_time_edit_outlet;
            // $data->update_by = $request->update_by_edit_outlet;
            // $data->save();

            // return response()->json(['success' => 'Added edit records Outlet.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);

        // // dd(count($photooutlet));

        // // dd("test ini post");
        // $status = 'success';
        // return $status;
    }

    public function AddItemCart($id, $name, $price, $qty, $gramature, $images)
    {
        // \Cart::add(
        //     [
        //         'id' => $id,
        //         'name' => $name,
        //         'price' => $price,
        //         'quantity' => $qty,
        //         'attributes' => array(
        //             'gramature' => $gramature,
        //             'images' => $images,
        //         )
        //     ]
        // );
    }
}
