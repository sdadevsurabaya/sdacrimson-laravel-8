<?php

namespace App\Http\Controllers;

use App\Models\Area_model;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $get_Area = Area_model::all();
        // $get_Brand = "list";
        // dd($get_Brand);
        return view('area.index',compact('get_Area'))
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

    public function get_area_id(Request $request)
    {
        $kota = str_replace('%20',' ',$request->kota);

        // $get_Area = DB::table('area')
        //             ->select('*')
        //             ->where([
        //                 ['detail', $kota]
        //             ])
        //             ->get();
        $get_Area = DB::select('select * from area where detail = "'.$kota.'"');

        echo $get_Area[0]->id;
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
            'area'   => 'required',
            'nama_area'   => 'required',
            'detarea' => 'required',

        ]);

        if ($validator->passes()) {
            $Area = Area_model::create([
                'area'   => $request->area,
                'nama_area'   => $request->nama_area,
                'detail'   => $request->detarea,
                'created_by'    => $request->created_by,
                'created_date'  => $request->created_date,
            ]);

            return response()->json(['success'=>'Added new records area.']);
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
        $Area = Area_model::find($id);

        return response()->json([
            'success' => true,
            'data'    => $Area
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'area_update'   => 'required',
            'nmarea_update'   => 'required',
            'detarea_update'   => 'required',
        ]);

        if ($validator->passes()) {
            $data = Area_model::find($request->id_update);
            $data->area = $request->area_update;
            $data->nama_area = $request->nmarea_update;
            $data->detail = $request->detarea_update;
            $data->created_by = $request->created_by_update;
            $data->created_date = $request->created_date_update;
            $data->update_by = $request->update_by;
            $data->update_date = $request->update_date;
            $data->save();

            return response()->json(['success'=>'Added update records area.']);
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
        Area_model::find($id)->delete();
        return response()->json(['success'=>'Success Delete records area.']);
    }
}
