<?php

namespace App\Http\Controllers\Api\Images_outlet;

use JWTAuth;
use App\Models\Outlet_model;
use Illuminate\Http\Request;
use App\Models\ImagesOutlet_model;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class PostImagesOutletController extends BaseController
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

        try {
            $validator = Validator::make($request->all(), [
                'foto' => 'image|mimes:jpeg,png,jpg,gif',
                'nama_foto' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            $user = JWTAuth::parseToken()->authenticate();

            //get id user login
            $userId = $user->id;
            //get id_customer which is being created by the logged in user
            $Outlet = Outlet_model::where('ar', $userId)->orderBy('created_at', 'desc')->first();

            $name = $request->nama_foto;

            // Simpan gambar menggunakan store()
            $image = $request->file('foto');
            $imageName = time()  . rand(1, 100) . '.' . $image->getClientOriginalExtension();

            $resizedImage = Image::make($image)->resize(850, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resizedImage->save(public_path('files/' . $imageName), 90);

            $imageOutlet = ImagesOutlet_model::create([
                'nama_foto' => $name,
                'foto' => $imageName,
                'id_outlet' => $Outlet->id,
            ]);

            return $this->sendResponse($imageOutlet->toArray(), 'Image created successfully.');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }
}
