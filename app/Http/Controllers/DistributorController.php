<?php

namespace App\Http\Controllers;

use App\Models\Distributor_model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $get_Distributor = Distributor_model::all();
        $dist = DB::table('jne_api')
        ->select('province_name')
        ->distinct()
        ->orderby('province_name', 'asc')
        ->get();

        return view('distributor.index',compact('get_Distributor','dist'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'id_dist'   => 'required',
            // 'type_usaha'   => 'required',
            // 'nama_dist'   => 'required',
            // 'address_type'  => 'required|not_in:0',
            // 'alamat'   => 'required',
            // 'provinsi_add_dist'   => 'required',
            // 'kota_add_dist'   => 'required',
            // 'kecamatan_add_dist'   => 'required',
            // 'kelurahan_add_dist'   => 'required',
            // 'kode_pos_add_dist'   => 'required',
            // 'lat'   => 'required',
            // 'longtitude'   => 'required',
            // 'created_by'   => 'required',
            // 'created_date'   => 'required',
            // 'update_by'   => 'required',
            // 'update_date'   => 'required',

        ]);

        if ($validator->passes()) {
            $Distributor = Distributor_model::create([
                'id_cust' => $request->id_dist,
                'type_usaha' => $request->type_usaha,
                'nama_cust' => $request->nama_dist,
                'address_type' => implode(",",$request->address_type),
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi_add_dist,
                'kota'  => $request->kota_add_dist,
                'kecamatan' => $request->kecamatan_add_dist,
                'kelurahan' => $request-> kelurahan_add_dist,
                'kode_pos'   => $request->kode_pos_add_dist,
                'latitude'   => $request->lat,
                'longtitude'   => $request->longtitude,
                'created_by'    => null,
                'created_date'  => null,
                'update_by' => null,
                'update_date' => null,
            ]);

            return response()->json(['success'=>'Added new records Distributor.']);
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
        $Distributor = Distributor_model::find($id);

        return response()->json([
            'success' => true,
            'data'    => $Distributor
        ]);
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
            // 'id_dist_update' => 'required',
            // 'type_update' => 'required',
            // 'nama_dist_update' => 'required',
            // 'address_type_update'  => 'required|not_in:0',
            // 'alamat_update' => 'required',
            // 'provinsi_update_dist' => 'required',
            // 'kota_update_dist' => 'required',
            // 'kecamatan_update_dist' => 'required',
            // 'kelurahan_update_dist' => 'required',
            // 'kode_pos_update_dist' => 'required',
            // 'lat_update' => 'required',
            // 'longtitude_update' => 'required',
            // 'created_by'   => 'required',
            // 'created_date'   => 'required',
            // 'update_by'   => 'required',
            // 'update_date'   => 'required',
        ]);

        if ($validator->passes()) {
            $data = Distributor_model::find($request->id_update);
            $data->id_cust = $request->id_dist_update;
            $data->type_usaha = $request->type_update;
            $data->nama_cust = $request->nama_dist_update;
            $data->address_type= implode(",",$request->address_type_update);
            $data->alamat= $request->alamat_update;
            $data->provinsi= $request->provinsi_update_dist;
            $data->kota = $request->kota_update_dist;
            $data->kecamatan= $request->kecamatan_update_dist;
            $data->kelurahan= $request-> kelurahan_update_dist;
            $data->kode_pos = $request->kode_pos_update_dist;
            $data->latitude = $request->lat_update;
            $data->longtitude = $request->longtitude_update;
            $data->created_by   = null;
            $data->created_date = null;
            $data->update_by= null;
            $data->update_date= null;
            
            $data->save();
            return response()->json(['success'=>'Added update records Distributor.']);
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
        Distributor_model::find($id)->delete();
        return response()->json(['success'=>'Success Delete records Distributor.']);
    }
   
    public function distributor($id)
    {
        $jne_api = DB::table('jne_api')
        ->select('province_name')
        ->distinct()
        ->orderby('province_name', 'asc')
        ->get();
    }

    public function get_kota_edit_dist(Request $request)
    {
        $getDataDist = Distributor_model::find($request->id);

        $city_names = DB::table('jne_api')
                    ->select('city_name')
                    ->distinct()
                    ->orderby('city_name', 'asc')
                    ->where('province_name', $getDataDist->provinsi)
                    ->get();

        foreach ($city_names as $city_name) {
            echo "<option value='".$city_name->city_name."'". ($city_name->city_name == $getDataDist->kota ? 'selected':'' ).">".$city_name->city_name."</option>";
        } ;
    }

    public function get_kecamatan_edit_dist(Request $request)
    {
        $getDataDist = Distributor_model::find($request->id);

        $district_names = DB::table('jne_api')
                    ->select('district_name')
                    ->distinct()
                    ->orderby('district_name', 'asc')
                    // ->where('city_name', $getDataDist->kota)
                    ->where([
                        ['province_name', $getDataDist->provinsi],
                        ['city_name', $getDataDist->kota]
                    ])
                    ->get();

        foreach ($district_names as $district_name) {
            echo "<option value='".$district_name->district_name."'". ($district_name->district_name == $getDataDist->kecamatan ? 'selected':'' ).">".$district_name->district_name."</option>";
        } ;
    }

    public function get_kelurahan_edit_dist(Request $request)
    {
        $getDataDist = Distributor_model::find($request->id);

        $subdidstrict_names = DB::table('jne_api')
                    ->select('subdidstrict_name')
                    ->distinct()
                    ->orderby('subdidstrict_name', 'asc')
                    // ->where('district_name', $getDataDist->kecamatan)
                    ->where([
                        ['province_name', $getDataDist->provinsi],
                        ['city_name', $getDataDist->kota],
                        ['district_name', $getDataDist->kecamatan],
                    ])
                    ->get();

        foreach ($subdidstrict_names as $subdidstrict_name) {
            echo "<option value='".$subdidstrict_name->subdidstrict_name."'". ($subdidstrict_name->subdidstrict_name == $getDataDist->kelurahan ? 'selected':'' ).">".$subdidstrict_name->subdidstrict_name."</option>";
        } ;
    }


}
