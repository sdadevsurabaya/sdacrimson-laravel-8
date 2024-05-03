<?php

namespace App\Http\Controllers;

use App\Models\Outlet_model;
use App\Models\Area_model;

use Illuminate\Http\Request;
use Validator;
use DB;

class MapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $outlet = Outlet_model::all();
        $areas = Area_model::select('area')->distinct()->get();

        return view('maps.index',compact('outlet', 'areas'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    function distance($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 6371000; // meters

        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);

        $dLat = $lat2Rad - $lat1Rad;
        $dLon = $lon2Rad - $lon1Rad;

        $a = sin($dLat / 2) * sin($dLat / 2) + cos($lat1Rad) * cos($lat2Rad) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show_all()
    {
        $outlet = Outlet_model::
        leftJoin("general_informations","general_informations.id_customer","=","outlet.id_customer")
        ->leftJoin("area","area.id","=","outlet.id_area")
        ->get();

        return json_encode($outlet);
    }

    public function show_all_by_area(Request $request)
    {

        $outlet = Outlet_model::
        leftJoin("general_informations","general_informations.id_customer","=","outlet.id_customer")
        ->leftJoin("area","area.id","=","outlet.id_area")
        ->where('area.area', $request->id)
        ->get();

        return json_encode($outlet);
    }

    public function show_all_by_radius(Request $request)
    {
        $lat = $request->lat;
        $long = $request->long;

        // dd($lat);
        $outlet_by_radius = DB::select('select * from outlet where latitude = "'.$lat.'" and longitude = "'.$long.'"');

        // $outlet = Outlet_model::
        // leftJoin("general_informations","general_informations.id_customer","=","outlet.id_customer")
        // ->leftJoin("area","area.id","=","outlet.id_area")
        // ->where('area.area', $request->id)
        // ->get();

        return json_encode($outlet_by_radius);
    }

    public function show($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
