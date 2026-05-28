<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\General_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PinCustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan list customer dengan data latitude/longitude
     */
    public function index(Request $request)
    {
        $query = General_model::join('users', 'users.id', '=', 'general_informations.ar')
            ->orderBy('general_informations.id', 'desc')
            ->select([
                'general_informations.id',
                'general_informations.id_customer',
                'general_informations.nama_usaha',
                'general_informations.alamat_kantor',
                'general_informations.latitude',
                'general_informations.longitude',
                'users.name as ar_name',
            ]);

        // Batasi akses berdasarkan role
        if (!Auth::user()->hasRole('Admin') && !Auth::user()->hasRole('Verifikator') && !Auth::user()->hasRole('Toko') && !Auth::user()->hasRole('Manager Sales')) {
            $query->where('general_informations.ar', Auth::user()->id);
        }

        $customers = $query->get();

        return view('general.pin_customer', compact('customers'));
    }

    /**
     * Update latitude dan longitude customer
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_usaha'    => 'required',
            'alamat_kantor' => 'required',
            'latitude'      => 'required|numeric|between:-90,90',
            'longitude'     => 'required|numeric|between:-180,180',
        ], [
            'latitude.required'  => 'Latitude wajib diisi.',
            'latitude.numeric'   => 'Latitude harus berupa angka.',
            'latitude.between'   => 'Latitude harus antara -90 dan 90.',
            'longitude.required' => 'Longitude wajib diisi.',
            'longitude.numeric'  => 'Longitude harus berupa angka.',
            'longitude.between'  => 'Longitude harus antara -180 dan 180.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $customer = General_model::findOrFail($id);
        $customer->alamat_kantor = $request->alamat_kantor;
        $customer->latitude  = $request->latitude;
        $customer->longitude = $request->longitude;
        $customer->save();

        Alert::success('Berhasil', 'Koordinat customer berhasil disimpan.');

        return redirect()->route('pin.customer.index');
    }
}
