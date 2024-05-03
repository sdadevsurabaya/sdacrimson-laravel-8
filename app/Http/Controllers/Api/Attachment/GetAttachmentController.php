<?php

namespace App\Http\Controllers\Api\Attachment;

use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Attachment_model;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\General_model;
use App\Http\Controllers\Controller;

class GetAttachmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'id_customer' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $fullUrl = url('/');

        $dataOutlet = Attachment_model::select('files', 'nama_files')
            ->where('id_customer', $request->id_customer)
            ->get();

        if ($dataOutlet->count() > 0) {
            $namaFilesArray = explode(',', $dataOutlet[0]->nama_files);




            $namaFilesString = $dataOutlet[0]->files;


            $FilesArray = explode(',', $namaFilesString);


            $fotoArray = [];
            foreach ($FilesArray as $namaFile) {
                $fotoArray[] = $fullUrl . '/files/' . $namaFile;
            }

            $fotofull = [];
            foreach ($namaFilesArray as $key => $namaFile) {
                $fotofull[] = [
                    'nama_foto' => $namaFile,
                    'foto' => $fotoArray[$key]
                ];
            }
            $result = [
                'success' => true,
                // 'nama_files' => $namaFilesArray,
                // 'foto' => $fotoArray,
                'fotofull' => $fotofull
            ];
            return response()->json($result);
        } else {

            return response()->json(['message' => 'Tidak ada data yang sesuai'], 404);
        }
    }
}
