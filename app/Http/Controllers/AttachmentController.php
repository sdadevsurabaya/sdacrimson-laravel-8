<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Models\Attachment_model;
use App\Models\General_model;
use Illuminate\Http\Request;
use Validator;

class AttachmentController extends Controller
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
        // dd($id);
        return view('berkas.attachment',compact('id'));
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
        date_default_timezone_set('Asia/Jakarta');

        $validator = Validator::make($request->all(), [
            // 'filenames'   => 'required',
            // 'filenames'   => 'required|mimes:png,jpg,jpeg|max:2048',
            // 'ar'            => 'required',
            // 'created_date'  => 'required',
        ]);

        if ($validator->passes()) {

            $findAttachment = DB::table('attachment')->where('id_customer', $request->id_customer)->first();

            $Attachment = $findAttachment;

            $files = [];
            $namaFiles = [];

            if ($Attachment != null) {
                $filesAttachment = explode(',', $Attachment->files);
                $namaFilesAttachment = explode(',', $Attachment->nama_files);
                // $callBack = "data dari";
                if ($request->to_data == "localStorage") {
                    // $callBack = "data dari localStorage";
                    // jika gambar single
                    // $gambar = $request->filenames;
                    // $extension = explode('/', mime_content_type($gambar))[1];
                    // $name = time() . rand(1, 100) . '.' . $extension;
                    // Image::make($gambar)->resize(850, null, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // })->save(public_path('files/' . $name));
                    // $namaFiles[] = $request->namaFile;

                    // $files[] = $name;

                    // jika gambar multiple
                    foreach ($request->filenames as $file) {

                        $extension = explode('/', mime_content_type($file))[1];

                        $name = time() . rand(1, 100) . '.' . $extension;
                        // $file->move(public_path('files'), $name);
                        Image::make($file)->resize(850, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save(public_path('files/' . $name));

                        $files[] = $name;
                        // $namaFiles[] = $request->namaFile;
                    }

                    $finalAttachment = array_merge($filesAttachment, $files);
                    $finalNamaFileAttachment = array_merge($namaFilesAttachment, $request->namaFile);
                    // $callBack = connection_status();
                    // $callBack = $finalNamaFileAttachment;
                } else {
                    // $callBack = "data dari localStorage kosong";
                    // $callBack = connection_status();
                    if ($request->hasfile('filenames')) {
                        foreach ($request->file('filenames') as $file) {
                            $name = time() . rand(1, 100) . '.' . $file->extension();
                            // $file->move(public_path('files'), $name);

                            Image::make($file)->resize(850, null, function ($constraint) {
                                $constraint->aspectRatio();
                            })->save(public_path('files/' . $name));

                            $files[] = $name;
                            // $namaFiles[] = $request->namaFile;

                        }

                        $finalAttachment = array_merge($filesAttachment, $files);
                        $finalNamaFileAttachment = array_merge($namaFilesAttachment, $request->namaFile);
                    }
                }

                $data = Attachment_model::find($Attachment->id);
                $data->id_customer = $Attachment->id_customer;
                $data->files = implode(",",$finalAttachment);
                $data->nama_files = implode(",",$finalNamaFileAttachment);
                $data->ar = $Attachment->ar;
                $data->created_by = $Attachment->created_by;
                $data->update_date = date("Y-m-d");
                $data->update_time = date('H:i:s');
                $data->update_by = $request->ar;

                // return response()->json(['success'=> $callBack]);

            } else {
                $callBack = "data attachment belum ada";

                if ($request->to_data == "localStorage") {

                    foreach ($request->filenames as $file) {

                        $extension = explode('/', mime_content_type($file))[1];

                        $name = time() . rand(1, 100) . '.' . $extension;
                        // $file->move(public_path('files'), $name);
                        Image::make($file)->resize(850, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save(public_path('files/' . $name));

                        $files[] = $name;
                        // $namaFiles[] = $request->namaFile;
                    }

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

                    $CreateAttachment = Attachment_model::create([
                        'id_customer'   => $id_customer,
                        'files'         => implode(",",$files),
                        'nama_files'    => implode(",",$request->namaFile),
                        'ar'            => $request->ar,
                        'created_date'  => $request->created_date,
                        'created_by'    => $request->ar,
                    ]);
                } else {
                    if ($request->hasfile('filenames')) {
                        foreach ($request->file('filenames') as $file) {
                            $name = time() . rand(1, 100) . '.' . $file->extension();
                            // $file->move(public_path('files'), $name);
                            Image::make($file)->resize(850, null, function ($constraint) {
                                $constraint->aspectRatio();
                            })->save(public_path('files/' . $name));

                            $files[] = $name;
                            // $namaFiles[] = $request->namaFile;
                        }

                        $CreateAttachment = Attachment_model::create([
                            'id_customer'   => $request->id_customer,
                            'files'         => implode(",",$files),
                            'nama_files'    => implode(",",$request->namaFile),
                            'ar'            => $request->ar,
                            'created_date'  => $request->created_date,
                            'created_by'    => $request->ar,
                        ]);
                    }
                }
            }

            // return response()->json(['success'=> $callBack]);
            return response()->json(['success'=>'Added new records attachment.']);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
