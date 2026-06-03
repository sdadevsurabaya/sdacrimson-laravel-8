<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\General_model;
use App\Models\DetailJadwal;
use App\Models\Attendance;
use App\Models\LaporanSales;
use App\Models\Outlet_model;
use App\Models\StatusData_model;
use App\Models\Legal_model;
use App\Models\Attachment_model;
use App\Models\Account_model;
use Illuminate\Support\Facades\DB;

class DuplicateCustomerController extends Controller
{
    public function index()
    {
        return view('duplicate_customer.index');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        if(empty($keyword)) {
            return response()->json([]);
        }
        $customers = General_model::where('nama_usaha', 'LIKE', '%' . $keyword . '%')
            ->orWhere('id_customer', 'LIKE', '%' . $keyword . '%')
            ->get();

        return response()->json($customers);
    }

    public function compare(Request $request)
    {
        $ids = $request->ids; // Array of general_id
        if(empty($ids)) {
             return response()->json([]);
        }

        $customers = General_model::whereIn('id', $ids)->get()->map(function($customer) {
             $customer->jadwals_count = DetailJadwal::where('general_id', $customer->id)->count();
             $customer->attendances_count = Attendance::where('general_id', $customer->id)->count();
             $customer->laporan_count = LaporanSales::where('general_id', $customer->id)->count();
             return $customer;
        });

        return response()->json($customers);
    }

    public function merge(Request $request)
    {
        $source_id = $request->source_id;
        $destination_id = $request->destination_id;

        if(empty($source_id) || empty($destination_id)) {
            return response()->json(['success' => false, 'message' => 'Pilih customer yang ingin digabungkan.']);
        }

        if($source_id == $destination_id) {
            return response()->json(['success' => false, 'message' => 'Customer asal dan tujuan tidak boleh sama.']);
        }

        $sourceCustomer = General_model::find($source_id);
        $destinationCustomer = General_model::find($destination_id);

        if(!$sourceCustomer || !$destinationCustomer) {
            return response()->json(['success' => false, 'message' => 'Data customer tidak ditemukan.']);
        }

        DB::beginTransaction();
        try {
            // Pindahkan history dari source ke destination (General ID)
            DetailJadwal::where('general_id', $source_id)->update(['general_id' => $destination_id]);
            Attendance::where('general_id', $source_id)->update(['general_id' => $destination_id]);
            LaporanSales::where('general_id', $source_id)->update(['general_id' => $destination_id]);
            
            // Pindahkan history dari source ke destination (Customer ID String)
            if ($sourceCustomer->id_customer && $destinationCustomer->id_customer) {
                Outlet_model::where('id_customer', $sourceCustomer->id_customer)->update(['id_customer' => $destinationCustomer->id_customer]);
                StatusData_model::where('id_customer', $sourceCustomer->id_customer)->update(['id_customer' => $destinationCustomer->id_customer]);
                Legal_model::where('id_customer', $sourceCustomer->id_customer)->update(['id_customer' => $destinationCustomer->id_customer]);
                Attachment_model::where('id_customer', $sourceCustomer->id_customer)->update(['id_customer' => $destinationCustomer->id_customer]);
                Account_model::where('id_customer', $sourceCustomer->id_customer)->update(['id_customer' => $destinationCustomer->id_customer]);
            }

            // Hapus atau update status source customer agar tidak terlihat lagi? 
            // Sebagai best practice, bisa dihapus atau ditandai. Mari kita hapus.
            $sourceCustomer->delete();

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Data customer berhasil digabungkan.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menggabungkan data: ' . $e->getMessage()]);
        }
    }
}
