<?php

namespace App\Http\Controllers;

use Auth;

use Validator;
use App\Models\Attendance;
use App\Models\Legal_model;
use App\Models\DrafId_model;
use App\Models\Outlet_model;
use Illuminate\Http\Request;
use App\Exports\OutletExport;
use App\Models\Account_model;
use App\Models\General_model;
use App\Exports\GeneralExport;

use App\Models\Attachment_model;
use App\Models\StatusData_model;
use App\Models\Distributor_model;
use Illuminate\Support\Facades\DB;

use App\Models\ContactPerson_model;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\DetailDistributor_model;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GeneralController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if (Auth::user()->hasRole("Admin") == 1 || Auth::user()->hasRole("Verifikator") == 1) {
            $data = General_model::join("users", "users.id", "=", "general_informations.ar")
                ->orderBy('general_informations.id', 'desc')
                ->get(['*', 'general_informations.id as id_general']);
        } else {
            $data = General_model::join("users", "users.id", "=", "general_informations.ar")
                ->where('ar', Auth::user()->id)
                ->orderBy('general_informations.id', 'desc')
                ->get(['*', 'general_informations.id as id_general']);
        }

        $getId = General_model::orderBy('id', 'desc')->get();
        // $id_customer = $getId[1]->id_customer;

        // return view('general.index',compact('data', 'id_customer'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
        return view('general.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        // $roles = Role::pluck('name','name')->all();
        // $data = General_model::orderBy('id','desc')->get();
        $data = General_model::count();
        if ($data == 0) {
            $id = 0;
        } else {
            $getId = General_model::orderBy('id', 'desc')->get();
            $id = $getId[0]->id_customer;
        }
        // dd($id);
        // die;
        return view('general.create', compact('id'));
    }

    public function generate_id_customer(Request $request)
    {
        $covert_huruf_besar = strtoupper($request->nama_usaha);
        $huruf = substr($covert_huruf_besar, 0, 3);
        // $data = General_model::orderBy('id','desc')->get(['general_informations.id as id_general']);
        // $urutan = $data[0]->id_general;
        $urutan = substr($request->id_general, -3);
        // $urutan = "LAN-001";
        $urutan++;
        $id_customer = $huruf . "-" . sprintf("%03s", $urutan);

        DrafId_model::create([
            'id_customer' => $id_customer,
            'id_outlet'   => null,
            'nama_usaha'  => $covert_huruf_besar,
            'alamat_kantor' => $request->alamat_kantor,
            'nama_lengkap' => $request->nama_lengkap,
            'mobile_phone' => $request->mobile_phone,
            'email'   => $request->email
        ]);

        // $DrafId = DrafId_model::where('id_customer', $id_customer)->orderby('id', 'desc')->first();

        // $data = DrafId_model::find($DrafId->id);
        // $data->id_outlet = $id_outlet;
        // $data->save();

        return response()->json(['success' => $id_customer]);
    }

    public function store(Request $request)
    {
        if ($request->to_data == "localStorage") {
            $validator = Validator::make($request->all(), [
                //
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                // 'id_customer'   => 'required',
                'type_usaha'    => 'required|not_in:0',
                'nama_usaha'    => 'required',
                'nama_lengkap'  => 'required',
                'alamat_kantor'  => 'required',
                'jabatan'       => 'required',
                'mobile_phone'  => 'required',
                // 'telepon'       => 'required',
                // 'email'         => 'required|email',
                // 'web_site'      => 'required',
                // 'no_npwp'       => 'required',
                // 'nama_npwp'     => 'required',
                // 'alamat_npwp'   => 'required',
                // 'nik'           => 'required',
                // 'created_date'  => 'required',
                // 'created_by'    => 'required',
                // 'update_date'   => 'required',
                // 'update_time'   => 'required',
            ]);
        }


        if ($validator->passes()) {

            $covert_huruf_besar = strtoupper($request->nama_usaha);
            $huruf = substr($covert_huruf_besar, 0, 3);
            // $data = General_model::orderBy('id','desc')->get(['general_informations.id as id_general']);
            // $urutan = $data[0]->id_general;
            if ($request->to_data == "localStorage") {
                $getId = General_model::orderBy('id', 'desc')->get();
                // $id = $getId[0]->id_customer;
                $urutan = substr($getId[0]->id_customer, -3);
            } else {
                $urutan = substr($request->id_general, -3);
            }
            // $urutan = "LAN-001";
            $urutan++;
            $id_customer = $huruf . "-" . sprintf("%03s", $urutan);

            $cekGeneral = General_model::where('id_customer', $id_customer)->get();

            // dd($cekGeneral);

            if (count($cekGeneral) > 0) {

                // Alert::error("Maaf data dengan ID Customer ".$id_customer." sudah terdaftar, silahkan melanjutkan pengisian pada menu berkas sesuai ID Customer")->autoClose(20000);
                // return back();

                echo '<script>
                        alert("Maaf data dengan ID Customer ' . $id_customer . ' belum lengkap, silahkan lengkapi data pada menu berkas sesuai ID Customer.");
                        window.location.href="' . url('admin/generals') . '";
                        </script>';
            } else {
                $data = General_model::create([
                    'id_customer' => $id_customer,
                    'id_customer_draf' => $request->id_customer_draf,
                    'type_usaha' => $request->type_usaha,
                    'nama_usaha' => $covert_huruf_besar,
                    'nama_lengkap' => $request->nama_lengkap,
                    'alamat_kantor' => $request->alamat_kantor,
                    'jabatan' => $request->jabatan,
                    'telepon' => $request->telepon,
                    'mobile_phone' => $request->mobile_phone,
                    'email' => $request->email,
                    'web_site' => $request->web_site,
                    'no_npwp' => $request->no_npwp,
                    'nama_npwp' => $request->nama_npwp,
                    'alamat_npwp' => $request->alamat_npwp,
                    'nik' => $request->nik,
                    'ar' => $request->ar,
                    'created_date' => $request->created_date,
                    'created_by' => $request->ar,
                    // 'update_date' => "null",
                    // 'update_time' => "null",
                    // 'update_by' => "null",
                ]);

                return response()->json(['success' => $id_customer]);

                // Alert::success('Berhasil ditambahkan', 'Data general berhasil ditambahkan');
                // return redirect("admin/generals/berkas/".$id_customer)
                //         // ->route("generals.index")
                //         ->with([
                //             'success' => 'New general information has been created ID Customer : '.$id_customer.''
                //         ]);
            }
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function show($id)
    {
        $cek_general = General_model::find($id);

        // dd($cek_general->id_customer);

        // if ($cek_general->update_by != null){
        //     $get_general = General_model::join("users as ar","ar.id","=","general_informations.ar")
        //     ->join("users as created_by","created_by.id","=","general_informations.created_by")
        //     ->join("users as update_by","update_by.id","=","general_informations.update_by")
        //     ->where('general_informations.id', $id)
        //     ->get(['*', 'general_informations.id as id_general', 'ar.name as ar', 'created_by.name as created_by', 'update_by.name as update_by']);
        // } else {

        $get_general = General_model::join("users as ar", "ar.id", "=", "general_informations.ar")
            ->join("users as created_by", "created_by.id", "=", "general_informations.created_by")
            ->where('general_informations.id', $id)
            ->get(['*', 'general_informations.email as email_general', 'ar.name as ar', 'created_by.name as created_by']);

        $get_legal = General_model::join("legal", "legal.id_customer", "=", "general_informations.id_customer")
            ->join("users as ar", "ar.id", "=", "legal.ar")
            ->join("users as created_by", "created_by.id", "=", "legal.created_by")
            ->where('general_informations.id', $id)
            ->get(['*', 'legal.status as status_legal', 'legal.remarks as remarks_legal']);

        $get_kontak = General_model::join("outlet", "outlet.id_customer", "=", "general_informations.id_customer")
            ->join("contact_person", "contact_person.id_outlet", "=", "outlet.id_outlet")
            ->join("users as ar", "ar.id", "=", "contact_person.ar")
            ->join("users as created_by", "created_by.id", "=", "contact_person.created_by")
            ->where('general_informations.id', $id)
            ->get(['*', 'contact_person.email as email_kontak', 'contact_person.status as status_kontak']);

        $get_account = General_model::join("account", "account.id_customer", "=", "general_informations.id_customer")
            ->join("users as ar", "ar.id", "=", "account.ar")
            ->join("users as created_by", "created_by.id", "=", "account.created_by")
            ->where('general_informations.id', $id)
            ->get(['*', 'account.status as status_account', 'account.remarks as remarks_account']);

        $get_attachment = General_model::join("attachment", "attachment.id_customer", "=", "general_informations.id_customer")
            ->where('general_informations.id', $id)
            ->get(['*']);

        $get_outlet = General_model::join("outlet", "outlet.id_customer", "=", "general_informations.id_customer")
            ->join("users as ar", "ar.id", "=", "outlet.ar")
            ->join("users as created_by", "created_by.id", "=", "outlet.created_by")
            ->leftJoin("area", "area.id", "=", "outlet.id_area")
            ->where('general_informations.id', $id)
            ->get(['*', 'area.area as area', 'outlet.id as id', 'outlet.status as status_outlet', 'outlet.remarks as remarks_outlet']);


        $get_statusData = StatusData_model::where('status_data.id_customer', $id)
            ->get(['status_data.id as id_status_data']);
        // }

        // if (count($get_legal) > 0 ){
        if (count($get_outlet) > 0) {
            // if (count($get_account) > 0) {
            // if (count($get_attachment) > 0) {
            $attachment = $get_attachment;
            $general = $get_general;
            $legal = $get_legal;
            $kontak = $get_kontak;
            $account = $get_account;
            $outlet = $get_outlet;
            $status_data = $get_statusData;
            // } else {
            //     Alert::error("Tampil Detail Gagal", "Maaf tidak dapat menampilkan detail customer karena Data Attachment pada ID Customer ".$cek_general->id_customer." belum ada, silahkan tambahkan Data Attachment pada menu berkas")->autoClose(20000);
            //     return back();

            // echo '<script>
            //     alert("Maaf tidak dapat menampilkan detail customer karena Data Attachment pada ID Customer '.$cek_general->id_customer.' belum ada, silahkan tambahkan Data Attachment pada menu berkas");
            //     window.location.href="'. url('admin/generals') .'";
            //     </script>' ;
            // }
            // } else {
            //     Alert::error("Tampil Detail Gagal", "Maaf tidak dapat menampilkan detail customer karena Data Account pada ID Customer ".$cek_general->id_customer." belum ada, silahkan tambahkan Data Account pada menu berkas")->autoClose(20000);
            //     return back();

            // echo '<script>
            //     alert("Maaf tidak dapat menampilkan detail customer karena Data Account pada ID Customer '.$cek_general->id_customer.' belum ada, silahkan tambahkan Data Account pada menu berkas");
            //     window.location.href="'. url('admin/generals') .'";
            //     </script>' ;
            // }
        } else {
            Alert::error("Tampil Detail Gagal", "Maaf tidak dapat menampilkan detail customer karena Data Outlet pada ID Customer " . $cek_general->id_customer . " belum ada, silahkan tambahkan Data Outlet pada menu berkas")->autoClose(20000);
            return back();

            // echo '<script>
            //   alert("Maaf tidak dapat menampilkan detail customer karena Data Outlet pada ID Customer '.$cek_general->id_customer.' belum ada, silahkan tambahkan Data Outlet pada menu berkas");
            //   window.location.href="'. url('admin/generals') .'";
            //   </script>' ;
        }
        // } else {
        //     Alert::error("Tampil Detail Gagal", "Maaf tidak dapat menampilkan detail customer karena Data Legal pada ID Customer ".$cek_general->id_customer." belum ada, silahkan tambahkan Data Legal pada menu berkas")->autoClose(20000);
        //     return back();

        // echo '<script>
        //       alert("Maaf data dengan ID Customer '.$cek_general->id_customer.' sudah terdaftar, silahkan melanjutkan pengisian pada menu berkas sesuai ID Customer.");
        //       window.location.href="'. url('admin/generals') .'";
        //       </script>' ;
        // }

        return view('general.detail_customer', compact('general', 'legal', 'kontak', 'account', 'attachment', 'outlet', 'status_data'));
    }

    public function edit($id)
    {
        $general = General_model::join("users", "users.id", "=", "general_informations.ar")
            ->where('general_informations.id', $id)
            ->get(['*', 'general_informations.id as id_general']);

            $checkin = Attendance::where('general_id', $id)
            ->where('status', 'check in')
            ->whereDate('created_at', now()->toDateString())
            ->first();

            $checkout = Attendance::where('general_id', $id)
                        ->where('status', 'check out')
                        ->whereDate('created_at', now()->toDateString())
                        ->first();

        return view('general.edit_customer', compact('general', 'checkin', 'checkout'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'id_customer'   => 'required',
            'type_usaha'    => 'required|not_in:0',
            'nama_usaha'    => 'required',
            'nama_lengkap'  => 'required',
            'jabatan'       => 'required',
            'alamat_kantor' => 'required',
            // 'telepon'       => 'required',
            // 'mobile_phone'  => 'required',
            // 'email'         => 'required|email',
            // 'web_site'      => 'required',
            // 'no_npwp'       => 'required',
            // 'nama_npwp'     => 'required',
            // 'alamat_npwp'   => 'required',
            // 'nik'           => 'required',
            // 'created_date'  => 'required',
            // 'created_by'    => 'required',
            // 'update_date'   => 'required',
            // 'update_time'   => 'required',
        ]);

        if ($validator->passes()) {

            $input = $request->all();
            // dd($input);
            $data = General_model::find($id);
            $data->update($input);

            Alert::success('Update Berhasil', 'Update data general berhasil');

            return redirect()
                ->route('generals.index')
                ->with([
                    'success' => 'Edit general information Berhasil'
                ]);
        }

        // dd($input);

        Alert::error('Update Gagal', 'Update data general gagal');
        return back();

        // echo '<script>
        //     alert("Maaf data kurang lengkap");
        //     window.location.href="'. url('admin/generals/update').'/'.$id.'";
        //     </script>' ;
    }

    public function destroy($id)
    {
        $getGeneral = General_model::find($id);
        General_model::find($id)->delete();
        Legal_model::where('id_customer', $getGeneral->id_customer)->delete();
        ContactPerson_model::join("outlet", "outlet.id_outlet", "=", "contact_person.id_outlet")->where('id_customer', $getGeneral->id_customer)->delete();
        Outlet_model::where('id_customer', $getGeneral->id_customer)->delete();
        Account_model::where('id_customer', $getGeneral->id_customer)->delete();
        Attachment_model::where('id_customer', $getGeneral->id_customer)->delete();
        StatusData_model::where('id_customer', $id)->delete();
        return response()->json(['success' => 'Success Delete records General.']);
    }

    public function berkas($id)
    {
        $id = $id;
        // dump($id);
        // die;
        // dd($id);
        return view('berkas.index', compact('id'));
        // ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function atribut(Request $request)
    {
        // dump($id);
        // die;
        $general = General_model::find($request->id);

        $legal = Legal_model::join("users", "users.id", "=", "legal.ar")
            ->orderBy('legal.id', 'desc')
            ->where('id_customer', $general->id_customer)
            ->get(['*', 'legal.id as id_legal', 'legal.status as status_legal', 'legal.remarks as remarks_legal']);

        $contact_person = ContactPerson_model::join("outlet", "outlet.id_outlet", "=", "contact_person.id_outlet")
            ->join("users", "users.id", "=", "contact_person.ar")
            ->orderBy('contact_person.id', 'desc')
            ->where('outlet.id_customer', $general->id_customer)
            ->get(['*', 'contact_person.email as email_kontak', 'contact_person.id as id_contact_person', 'contact_person.status as status_kontak']);

        $outlet = Outlet_model::join("users", "users.id", "=", "outlet.ar")
            ->leftJoin("area", "area.id", "=", "outlet.id_area")
            ->orderBy('outlet.id', 'desc')
            ->where('id_customer', $general->id_customer)
            ->get(['*', 'area.area as area', 'outlet.id as id_outlet', 'outlet.id_outlet as id_outlet_custom']);

        $detail_distributor = DetailDistributor_model::join("outlet", "outlet.id_outlet", "=", "detail_customers.id_outlet")
            ->join("customers", "customers.id_cust", "=", "detail_customers.id_cust")
            ->join("users", "users.id", "=", "detail_customers.ar")
            ->orderBy('detail_customers.id', 'desc')
            ->where('outlet.id_customer', $general->id_customer)
            ->get(['*', 'detail_customers.id as id_detail_distributor', 'outlet.id_outlet as id_outlet', 'customers.id_cust as id_customers', 'customers.nama_cust as nama_customer', 'detail_customers.brand as brand', 'detail_customers.status as status', 'users.name as name']);

        $account = Account_model::join("users", "users.id", "=", "account.ar")
            ->orderBy('account.id', 'desc')
            ->where('id_customer', $general->id_customer)
            ->get(['*', 'account.id as id_account']);

        $distributor = Distributor_model::all();

        $jne_api = DB::table('jne_api')
            ->select('province_name')
            ->distinct()
            ->orderby('province_name', 'asc')
            ->get();

        $type_outlet = DB::table('type_outlet')
            ->select('type_outlet')
            ->distinct()
            ->orderby('type_outlet', 'asc')
            ->get();

        $area = DB::table('area')
            ->select('*')
            ->distinct()
            ->orderby('area', 'asc')
            ->get();

        $brand = DB::table('brand')
            ->select('brand')
            ->distinct()
            ->orderby('brand', 'asc')
            ->get();

        $bank = DB::table('bank')
            ->select('bank')
            ->distinct()
            ->orderby('bank', 'asc')
            ->get();

        return view('general.atribut', compact('general', 'legal', 'account', 'contact_person', 'distributor', 'outlet', 'detail_distributor', 'jne_api', 'type_outlet', 'area', 'brand', 'bank'));
        // ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function export_excel_general(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $date = date('Y-m-d');

        ob_end_clean();
        ob_start();
        $data = Excel::download(new GeneralExport($dari, $sampai), 'general-' . $date . '.xlsx');

        return $data;
    }

    public function export_excel_outlet(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $date = date('Y-m-d');

        ob_end_clean();
        ob_start();
        $data = Excel::download(new OutletExport($dari, $sampai), 'outlet-' . $date . '.xlsx');

        return $data;
    }

    public function generate_qrcode(Request $request)
    {
        $data = Outlet_model::findOrFail($request->id);
        // dd($data->id_outlet);
        Outlet_model::where("id", $request->id)->update(["status_generate_qrcode" => 1]);
        $qrcode = QrCode::size(400)->generate($data->id_outlet, public_path('qrcode/' . $data->id_outlet . '.svg'));

        // $qrcode = QrCode::merge(public_path('qrcode/icon.png'))->size(400)->errorCorrection('H')->generate($data->id_outlet, public_path('qrcode/' . $data->id_outlet . '.svg'));
        // return view('qrcode',compact('qrcode'));
        // return $qrcode;
        Alert::success('Generate Berhasil', 'Generate Qrcode Id Outlet ' . $data->id_outlet . ' berhasil');

        return redirect()
            ->route('generals.index')
            ->with([
                'success' => 'Generate Qrcode Id Outlet ' . $data->id_outlet . ' berhasil'
            ]);
    }

    public function scan_qrcode(Request $request)
    {
        // dd($request->qr_code);
        $data = General_model::join("outlet", "outlet.id_customer", "=", "general_informations.id_customer")
            ->where('outlet.id_outlet', $request->qr_code)
            // ->where('outlet.id', 13)
            // ->first();
            ->get(['*', 'general_informations.id as id_general']);

        if (count($data) > 0) {
            return response()->json([
                'status' => 200,
                // 'id_general' => $data[0]->id_general,
                'url' => route('generals.show', ['id' => $data[0]->id_general]),
            ]);
        } else {
            return response()->json([
                'status' => 400,
                // 'id_general' => $data[0]->id_general,
            ]);
        }
    }

    public function visit($id)
    {
        // dd($id);

        $general = General_model::find($id);
        $attendance = Attendance::with(['user'])->orderBy('created_at','desc')->get();
        // dd($attendance);
        return view('general.visit', compact('general', 'attendance'));
    }
}
