<?php

namespace App\Http\Controllers;

use App\Models\Bank_model;

use Illuminate\Http\Request;
use Validator;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $get_Bank = Bank_model::all();
        // $get_Bank = "list";
        // dd($get_Bank);
        return view('bank.index',compact('get_Bank'))
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
            'bank'   => 'required',
        ]);

        if ($validator->passes()) {
            $Bank = Bank_model::create([
                'bank'   => $request->bank,
                'created_by'    => $request->created_by,
                'created_date'  => $request->created_date,
            ]);

            return response()->json(['success'=>'Added new records bank.']);
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
        $Bank = Bank_model::find($id);

        return response()->json([
            'success' => true,
            'data'    => $Bank
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
            'bank_update'   => 'required',
        ]);

        if ($validator->passes()) {
            $data = Bank_model::find($request->id_update);
            $data->bank = $request->bank_update;
            $data->created_by = $request->created_by_update;
            $data->created_date = $request->created_date_update;
            $data->update_by = $request->update_by;
            $data->update_date = $request->update_date;
            $data->save();

            return response()->json(['success'=>'Added update records bank.']);
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
        Bank_model::find($id)->delete();
        return response()->json(['success'=>'Success Delete records bank.']);
    }
}
