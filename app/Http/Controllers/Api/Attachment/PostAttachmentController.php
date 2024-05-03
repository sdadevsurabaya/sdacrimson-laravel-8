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

class PostAttachmentController extends Controller
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
        date_default_timezone_set('Asia/Jakarta');

        try {
            $validator = Validator::make($request->all(), [
                'files.*' => 'image|mimes:jpeg,png,jpg,gif',
                'id_customer' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                ], 200);
            }


            $ImageUpload = [];
            $nameFiles = [];

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $index => $image) {
                    $imageName = time()  . rand(1, 100) . '.' . $image->getClientOriginalExtension();

                    $resizedImage = Image::make($image)->resize(850, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $resizedImage->save(public_path('files/' . $imageName), 90);

                    $ImageUpload[] = $imageName;
                    $nameFiles[] = $request->nama_files[$index];
                }
            }

            $imageString = implode(',', $ImageUpload);
            $nameString = implode(',', $nameFiles);
            $now = Carbon::now();
            $createdDate = $now->format('Y-m-d');

            //parse token get user login
            $user = JWTAuth::parseToken()->authenticate();

            //get role user login
            $userId = $user->id;

            //get id_customer which is being created by the logged in user
            $General = General_model::where('ar', $userId)->orderBy('created_at', 'desc')->first();
            // dd($userId);
            if ($request->has('files')) {
                $Attachment = Attachment_model::create([
                    'nama_files' => $nameString,
                    'id_customer' => $request->id_customer,
                    'files' => $imageString,
                    'ar' => $userId,
                    'created_date' => $createdDate,
                    'created_by' => $userId
                ]);
                $response = [
                    'success' => true,
                    'message' => 'Attachement created successfully..',
                    'data' => $Attachment,
                ];

                return response()->json($response, 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Attachement blank',
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
