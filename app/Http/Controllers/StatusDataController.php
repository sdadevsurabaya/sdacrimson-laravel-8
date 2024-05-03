<?php

namespace App\Http\Controllers;

use App\Models\StatusData_model;
use App\Models\General_model;

use Illuminate\Http\Request;
use Validator;

class StatusDataController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status_data'   => 'required',
            'remarks_status_data'=> 'required',
        ]);

        if ($validator->passes()) {
            $data = StatusData_model::create([
                'id_customer' => $request->id_customer,
                'status_data' => $request->status_data,
                'remarks' => $request->remarks_status_data,
                'id_user_validator' => $request->id_user_validator,
                'created_date' => $request->created_date,
                'created_time' => $request->created_time,
                'created_by' => $request->id_user_validator,
                // 'update_date' => "null",
                // 'update_time' => "null",
                // 'update_by' => "null",
            ]);

            return response()->json(['success'=>'Added records Status Data Id Customer '.$request->code_customer.'.']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function show($id)
    {
        $status_data = StatusData_model::find($id);

        return response()->json([
            'success' => true,
            'data'    => $status_data
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status_data_edit'   => 'required',
            'remarks_status_data_edit'=> 'required',
        ]);

        $get_general = General_model::find($request->id_customer_edit);

        if ($validator->passes()) {
            $data = StatusData_model::find($request->id_status_data_edit);
            $data->id_customer = $request->id_customer_edit;
            $data->status_data = $request->status_data_edit;
            $data->remarks = $request->remarks_status_data_edit;
            $data->id_user_validator = $request->id_user_validator_edit_old;
            $data->created_date = $request->created_date_edit;
            $data->created_time = $request->created_time_edit;
            $data->created_by = $request->id_user_validator_edit_old;
            $data->update_date = $request->update_date_edit;
            $data->update_time = $request->update_time_edit;
            $data->update_by = $request->id_user_validator_edit;
            $data->save();

            return response()->json(['success'=>'Added edit records Status Data Id Customer '.$get_general->id_customer.'.']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

}
