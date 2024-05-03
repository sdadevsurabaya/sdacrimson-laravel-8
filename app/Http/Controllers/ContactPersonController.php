<?php

namespace App\Http\Controllers;

use App\Models\ContactPerson_model;

use Illuminate\Http\Request;
use Validator;

class ContactPersonController extends Controller
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
                'nama_lengkap'  => 'required',
                'no_telpon'     => 'required',
                // 'email'         => 'required',
                // 'jabatan'       => 'required',
                // 'status'        => 'required|not_in:0',
                // 'created_date'  => 'required',
                // 'ar'            => 'required',
            ]);
        }


        if ($validator->passes()) {
            $CreateLegal = ContactPerson_model::create([
                'id_outlet'     => $request->id_outlet,
                'nama_lengkap'  => $request->nama_lengkap,
                'no_telpon'     => $request->no_telpon,
                'email'         => $request->email,
                'jabatan'       => $request->jabatan,
                'status'        => $request->status,
                'ar'            => $request->ar,
                'created_date'  => $request->created_date,
                'created_by'    => $request->ar,
            ]);

            return response()->json(['success'=>'Added new records contact person.']);
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
        $contact = ContactPerson_model::find($id);

        return response()->json([
            'success' => true,
            'data'    => $contact
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
            'id_outlet_edit_kontak'   => 'required',
            'nama_lengkap_edit_kontak'=> 'required',
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
            $data = ContactPerson_model::find($request->id_edit_kontak);
            $data->id_outlet = $request->id_outlet_edit_kontak;
            $data->nama_lengkap = $request->nama_lengkap_edit_kontak;
            $data->no_telpon = $request->no_telpon_edit_kontak;
            $data->email = $request->email_edit_kontak;
            $data->jabatan = $request->jabatan_edit_kontak;
            $data->status = $request->status_edit_kontak;
            $data->ar = $request->created_by_edit_kontak;
            $data->created_date = $request->created_date_edit_kontak;
            $data->created_by = $request->created_by_edit_kontak;
            $data->update_date = $request->update_date_edit_kontak;
            $data->update_time = $request->update_time_edit_kontak;
            $data->update_by = $request->update_by_edit_kontak;
            $data->save();

            return response()->json(['success'=>'Added edit records Kontak.']);
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
        ContactPerson_model::find($id)->delete();
        return response()->json(['success'=>'Success Delete records Kontak.']);
    }
}
