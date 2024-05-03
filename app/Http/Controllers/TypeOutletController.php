<?php

namespace App\Http\Controllers;

use App\Models\TypeOutlet_model;

use Illuminate\Http\Request;
use Validator;

class TypeOutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $get_TypeOutlet = TypeOutlet_model::all();
        // dd($get_TypeOutlet);
        return view('type-outlet.index',compact('get_TypeOutlet'))
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
            'type_outlet'   => 'required',
        ]);

        if ($validator->passes()) {
            $TypeOutlet = TypeOutlet_model::create([
                'type_outlet'   => $request->type_outlet,
                'created_by'    => $request->created_by,
                'created_date'  => $request->created_date,
            ]);

            return response()->json(['success'=>'Added new records type outlet.']);
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
        $TypeOutlet = TypeOutlet_model::find($id);

        return response()->json([
            'success' => true,
            'data'    => $TypeOutlet
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
            'type_outlet_update'   => 'required',
        ]);

        if ($validator->passes()) {
            $data = TypeOutlet_model::find($request->id_update);
            $data->type_outlet = $request->type_outlet_update;
            $data->created_by = $request->created_by;
            $data->created_date = $request->created_date;
            $data->update_by = $request->update_by;
            $data->update_date = $request->update_date;
            $data->save();

            return response()->json(['success'=>'Added edit records type outlet.']);
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
        TypeOutlet_model::find($id)->delete();
        return response()->json(['success'=>'Success Delete records type outlet.']);
    }
}
