<?php

namespace App\Http\Controllers;

use App\Models\Account_model;
use App\Models\General_model;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;

class AccountController extends Controller
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
        $bank = DB::table('bank')
            ->select('bank')
            ->distinct()
            ->orderby('bank', 'asc')
            ->get();

        return view('berkas.account',compact('id', 'bank'));
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
                'id_customer'   => 'required',
                // 'payment_trems' => 'required',
                // 'id_price'      => 'required',
                // 'credit_limit'  => 'required',
                // 'max_nota'      => 'required',
                // 'bank'          => 'required|not_in:0',
                // 'atas_nama'     => 'required',
                // 'no_rek'        => 'required',
                // 'cabang'        => 'required',
                // 'status'        => 'required|not_in:0',
                // 'remarks'       => 'required',
                // 'ar'            => 'required',
                // 'created_date'  => 'required',
            ]);
        }


        if ($validator->passes()) {
            if ($request->payment_trems != null) {
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

                $CreateAccount = Account_model::create([
                    'id_customer'   => $id_customer,
                    'payment_trems' => $request->payment_trems,
                    'id_price'      => $request->id_price,
                    'credit_limit'  => $request->credit_limit,
                    'max_nota'      => $request->max_nota,
                    'bank'          => $request->bank,
                    'atas_nama'     => $request->atas_nama,
                    'no_rek'        => $request->no_rek,
                    'cabang'        => $request->cabang,
                    'status'        => $request->status_account,
                    'remarks'       => $request->remarks_account,
                    'ar'            => $request->ar,
                    'created_date'  => $request->created_date,
                    'created_by'    => $request->ar,
                ]);
            }
            return response()->json(['success'=>'Added new records account.']);
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
        $account = Account_model::find($id);

        return response()->json([
            'success' => true,
            'data'    => $account
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
            'id_edit_akun'   => 'required',
            'id_customer_edit_akun'=> 'required',
            'syaratpem_edit_akun'   => 'required',
            // 'idharga_edit_akun'       => 'required',
            // 'kreditlimit_edit_akun'     => 'required',
            // 'MaksNota_edit_akun'      => 'required',
            // 'bank_edit_akun'   => 'required',
            // 'atas_nama_edit_akun'       => 'required',
            // 'akun_edit_akun'     => 'required',
            // 'cabang_edit_akun'      => 'required',
            // 'status_edit_akun'     => 'required',
            // 'remarks_edit_akun'      => 'required',
            // 'created_date_edit_akun'=> 'required',
            // 'created_by_edit_akun'  => 'required',
            // 'update_date_edit_akun'  => 'required',
            // 'update_time_edit_akun'  => 'required',
            // 'update_by_edit_akun'    => 'required',
        ]);

        if ($validator->passes()) {
            $data = Account_model::find($request->id_edit_akun);
            $data->id_customer = $request->id_customer_edit_akun;
            $data->payment_trems = $request->syaratpem_edit_akun;
            $data->id_price = $request->idharga_edit_akun;
            $data->credit_limit = $request->kreditlimit_edit_akun;
            $data->max_nota = $request->MaksNota_edit_akun;
            $data->bank = $request->bank_edit_akun;
            $data->atas_nama = $request->atas_nama_edit_akun;
            $data->no_rek = $request->akun_edit_akun;
            $data->cabang = $request->cabang_edit_akun;
            $data->status = $request->status_edit_akun;
            $data->remarks = $request->remarks_edit_akun;
            $data->ar = $request->created_by_edit_akun;
            $data->created_date = $request->created_date_edit_akun;
            $data->created_by = $request->created_by_edit_akun;
            $data->update_date = $request->update_date_edit_akun;
            $data->update_time = $request->update_time_edit_akun;
            $data->update_by = $request->update_by_edit_akun;
            $data->save();

            return response()->json(['success'=>'Added edit records account.']);
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
        Account_model::find($id)->delete();
        return response()->json(['success'=>'Success Delete records Account.']);
    }
}
