<?php

namespace App\Http\Controllers;

use App\Models\DetailDistributor_model;
use App\Models\General_model;
use App\Models\Outlet_model;
use App\Models\DrafId_model;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
// use Datatables;

class DetailDistributorController extends Controller
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
        // $getGeneral = General_model::where('id_customer', $id)->first();

        $getOutlet = Outlet_model::where('id_customer', $id)->orderby('id', 'desc')->first();

        $distributor = DB::table('customers')
                    ->select('*')
                    // ->distinct()
                    ->orderby('id', 'asc')
                    ->get();

        $brand = DB::table('brand')
                ->select('brand')
                ->distinct()
                ->orderby('brand', 'asc')
                ->get();

        return view('berkas.detail_distributor',compact('id','getOutlet', 'distributor', 'brand'));
    }

    public function show_id_outlet(Request $request)
    {
        $id = $request->id;

        $DataOutlet = Outlet_model::where('id_customer', $id)->orderby('id', 'desc')->first();

        return response()->json([
            'success' => true,
            'data'    => $DataOutlet
        ]);
    }

    public function show_draf_id_outlet(Request $request)
    {
        $id = $request->id;

        $DrafId = DrafId_model::where('id_customer', $id)->orderby('id', 'desc')->first();

        return response()->json([
            'success' => true,
            'data'    => $DrafId
        ]);
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
        if ($request->to_data == "localStorage") {
            $validator = Validator::make($request->all(), [

            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'id_outlet'     => 'required|not_in:0',
                'id_distributor'=> 'required|not_in:0',
                'brand'         => 'required',
                // 'email'         => 'required',
                // 'jabatan'       => 'required',
                // 'status'        => 'required|not_in:0',
                // 'created_date'  => 'required',
                // 'ar'            => 'required',
            ]);
        }

        if ($validator->passes()) {
            $CreateLegal = DetailDistributor_model::create([
                'id_cust'       => $request->id_distributor,
                'id_outlet'     => $request->id_outlet,
                'brand'         => implode(",",$request->brand),
                'status'        => $request->status_detail_distributor,
                'ar'            => $request->ar,
                'created_date'  => $request->created_date,
                'created_by'    => $request->ar,
            ]);

            return response()->json(['success'=>'Added new records detail distributor.']);
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
        // $detail_distributor = DetailDistributor_model::
        // join("customers","customers.id","=","detail_customers.id_cust")
        // ->where('detail_customers.id', $id)
        // ->get(['*','detail_customers.id as id', 'customers.id_cust as id_cust', 'detail_customers.created_date as created_date', 'detail_customers.created_by as created_by']);

        $detail_distributor = DetailDistributor_model::find($id);

        return response()->json([
            'success' => true,
            'data'    => $detail_distributor
        ]);
    }

    public function tampilDetailDistributor($id)
	{
        $detailDistributorByIdOutlet = DetailDistributor_model::where('id_outlet', $id)->get();
		return response()->json($detailDistributorByIdOutlet);
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
            // 'id_outlet'     => 'required|not_in:0',
            'id_distributor_edit_detail_distributor'=> 'required|not_in:0',
            'brand_detail_distributor_edit_detail_distributor'         => 'required',
            // 'no_telpon_edit_kontak'   => 'required',
            // 'email_edit_kontak'       => 'required',
            // 'jabatan_edit_kontak'     => 'required',
            // 'status_edit_kontak'      => 'required',
            // 'created_date_edit_kontak'=> 'required',
            // 'created_by_edit_kontak'  => 'required',
            // 'update_date_edit_legal'  => 'required',
            // 'update_time_edit_legal'  => 'required',
            // 'update_by_edit_legal'    => 'required',
        ]);

        if ($validator->passes()) {
            $data = DetailDistributor_model::find($request->id_edit_detail_distributor);
            $data->id_cust = $request->id_distributor_edit_detail_distributor;
            $data->id_outlet = $request->id_outlet_edit_detail_distributor;
            $data->brand = implode(",",$request->brand_detail_distributor_edit_detail_distributor);

            $data->status = $request->status_edit_detail_distributor;
            $data->ar = $request->created_by_edit_detail_distributor;
            $data->created_date = $request->created_date_edit_detail_distributor;
            $data->created_by = $request->created_by_edit_detail_distributor;
            $data->update_date = $request->update_date_edit_detail_distributor;
            $data->update_time = $request->update_time_edit_detail_distributor;
            $data->update_by = $request->update_by_edit_detail_distributor;
            $data->save();

            return response()->json(['success'=>'Added edit records detail distributor.']);
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
        DetailDistributor_model::find($id)->delete();
        return response()->json(['success'=>'Success Delete records Detail Distributor.']);
    }
}
