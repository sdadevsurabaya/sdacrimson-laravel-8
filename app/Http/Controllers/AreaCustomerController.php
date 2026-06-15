<?php

namespace App\Http\Controllers;

use App\Models\AreaCustomer;
use Illuminate\Http\Request;
use Validator;

class AreaCustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $get_Area = AreaCustomer::all();
        return view('area-customer.index', compact('get_Area'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_area' => 'required',
            'kota' => 'required',
        ]);

        if ($validator->passes()) {
            $prefix = strtoupper(substr($request->kota, 0, 3));
            $lastArea = AreaCustomer::where('kode_area', 'like', $prefix . '-%')->orderBy('id', 'desc')->first();
            $number = 1;
            if ($lastArea && $lastArea->kode_area) {
                $lastCode = explode('-', $lastArea->kode_area);
                if (isset($lastCode[1])) {
                    $number = intval($lastCode[1]) + 1;
                }
            }
            $kode_area = $prefix . '-' . str_pad($number, 3, '0', STR_PAD_LEFT);

            AreaCustomer::create([
                'kode_area' => $kode_area,
                'nama_area' => $request->nama_area,
                'kota' => $request->kota,
                'deskripsi' => $request->deskripsi,
            ]);

            return response()->json(['success' => 'Added new records area.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function show($id)
    {
        $area = AreaCustomer::find($id);

        return response()->json([
            'success' => true,
            'data'    => $area
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_area_update' => 'required',
            'kota_update' => 'required',
        ]);

        if ($validator->passes()) {
            $data = AreaCustomer::find($request->id_update);
            $data->nama_area = $request->nama_area_update;
            $data->kota = $request->kota_update;
            $data->deskripsi = $request->deskripsi_update;
            $data->save();

            return response()->json(['success' => 'Added update records area.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function destroy($id)
    {
        AreaCustomer::find($id)->delete();
        return response()->json(['success' => 'Success Delete records area.']);
    }
}
