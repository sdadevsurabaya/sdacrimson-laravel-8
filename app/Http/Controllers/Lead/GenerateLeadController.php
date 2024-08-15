<?php

namespace App\Http\Controllers\Lead;

use Illuminate\Http\Request;
use App\Models\CustomerBackup;
use App\Http\Controllers\Controller;
use App\Models\General_model;

class GenerateLeadController extends Controller
{
    public function index()
    {
       
    $getCustomer = CustomerBackup::where('status', 0)->get();

    foreach ($getCustomer as $customer) {

        $covert_huruf_besar = strtoupper($customer->nama_usaha);
        $huruf = substr($covert_huruf_besar, 0, 3);

        $latest_general = General_model::orderBy('id', 'desc')->first();
        if ($latest_general) {
            $urutan = intval(substr($latest_general->id_customer, strrpos($latest_general->id_customer, '-') + 1));
            $urutan++; 
        } else {
            $urutan = 0;
        }

        $id_customer = $huruf . "-" . sprintf("%03d", $urutan);


     
        General_model::updateOrCreate(
         
            ['nama_usaha' => $customer->nama_usaha],
            
      
            [
                'id_customer' => $id_customer,
                'alamat_kantor' => $customer->alamat_kantor,
                'nama_lengkap' => $customer->contact_person,
                'mobile_phone' => $customer->no_hp,
                'status' => 'Lead',
                'ar' => 10,
            ]
        );
        

       
        $customer->update(['status' => 1]);
    }

    return response()->json(['message' => 'Data successfully transferred and updated'], 200);
    }
}
