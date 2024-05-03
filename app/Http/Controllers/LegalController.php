<?php

namespace App\Http\Controllers;

use App\Models\Legal_model;
use App\Models\General_model;

use Illuminate\Http\Request;
use Validator;

class LegalController extends Controller
{
    public function index(Request $request)
    {
        // $legal = Legal_model::join("users","users.id","=","legal.created_by")
        //     ->orderBy('legal.id','desc')
        //     ->get(['*', 'legal.id as id_legal']);

        // return response()->json([
        //     'success' => true,
        //     'data'    => $legal
        // ]);

    }

    public function show_form(Request $request)
    {
        $id = $request->id;
        // dd($id);
        return view('berkas.legal',compact('id'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // $postall = $request->all(); //tangkap semua parameter yang di post
        // Legal_model::insert($postall);
        if ($request->to_data == "localStorage") {
            $validator = Validator::make($request->all(), [

            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'id_customer'   => 'required',
                // 'tahun_berdiri' => 'required',
                // 'no_siup'       => 'required',
                // 'no_tdp'        => 'required',
                // 'remarks'       => 'required',
                // 'ar'            => 'required',
                // 'created_date'  => 'required',
            ]);
        }


        if ($validator->passes()) {
            if ($request->tahun_berdiri != null) {
                if ($request->to_data == "localStorage") {
                    // $getId = General_model::where('id_customer_draf', $request->id_customer)->orderBy('id_customer_draf','desc')->get();
                    // $id_customer = $getId[0]->id_customer;

                    $getId = DB::select('select * from general_informations where id_customer_draf = "'.$request->id_customer.'"');

                    if ($getId) {
                        $id_customer = $getId[0]->id_customer;
                    } else {
                        $id_customer = $request->id_customer;
                    }
                } else {
                    $getId = General_model::orderBy('id','desc')->get();
                    $id_customer = $getId[0]->id_customer;
                }

                $CreateLegal = Legal_model::create([
                    'id_customer'   => $id_customer,
                    'tahun_berdiri' => $request->tahun_berdiri,
                    'no_siup'       => $request->no_siup,
                    'no_tdp'        => $request->no_tdp,
                    'remarks'       => $request->remarks,
                    'ar'            => $request->ar,
                    'status'        => "Aktif",
                    'created_date'  => $request->created_date,
                    'created_by'    => $request->ar,
                ]);
            }
            return response()->json(['success'=>'Added new records legal.']);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function show($id)
    {
        $legal = Legal_model::find($id);

        return response()->json([
            'success' => true,
            'data'    => $legal
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_customer_edit_legal'   => 'required',
            'tahun_berdiri_edit_legal' => 'required',
            // 'no_siup_edit_legal'       => 'required',
            // 'no_tdp_edit_legal'        => 'required',
            // 'remarks_edit_legal'       => 'required',
            // 'created_date_edit_legal'  => 'required',
            // 'created_by_edit_legal'    => 'required',
            // 'update_date_edit_legal'   => 'required',
            // 'update_time_edit_legal'   => 'required',
            // 'update_by_edit_legal'     => 'required',
        ]);

        if ($validator->passes()) {
            $data = Legal_model::find($request->id_edit_legal);
            $data->id_customer = $request->id_customer_edit_legal;
            $data->tahun_berdiri = $request->tahun_berdiri_edit_legal;
            $data->no_siup = $request->no_siup_edit_legal;
            $data->no_tdp = $request->no_tdp_edit_legal;
            $data->remarks = $request->remarks_edit_legal;
            $data->ar = $request->created_by_edit_legal;
            $data->status = $request->status_edit_legal;
            $data->created_date = $request->created_date_edit_legal;
            $data->created_by = $request->created_by_edit_legal;
            $data->update_date = $request->update_date_edit_legal;
            $data->update_time = $request->update_time_edit_legal;
            $data->update_by = $request->update_by_edit_legal;
            $data->save();

            return response()->json(['success'=>'Added edit records legal.']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function destroy($id)
    {
        Legal_model::find($id)->delete();
        // return redirect()->route('generals.index')
        //                 ->with('success','General deleted successfully');
    }
}
