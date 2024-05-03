<?php

namespace App\Http\Controllers\Front;


use App\Models\Product_model;
use App\Models\Product_collection_model;
use App\Models\Product_type_model;
use App\Models\Product_form_model;
use App\Models\Product_package_model;
use App\Models\File;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FrontLandingController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $login = $request->session()->get('id');
        // dd($login);

        $title = 'home';
        $pages = 'landing';

        return view('front/signin', compact('title', 'pages'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $product_collection_models =  DB::table('product_collection_models')->get();
        // $product_type_models =  DB::table('product_type_models')->get();
        // $product_form_models =  DB::table('product_form_models')->get();
        // $product_package_models =  DB::table('product_package_models')->get();
        // return view('products/create', compact('product_collection_models', 'product_type_models', 'product_form_models', 'product_package_models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $this->validate($request, [
        //     'product_name' => 'required'
        // ]);

        // $files = [];
        // if ($request->hasfile('filenames')) {
        //     foreach ($request->file('filenames') as $file) {
        //         $name = time() . rand(1, 100) . '.' . $file->extension();
        //         $file->move(public_path('files/product-images'), $name);
        //         $files[] = $name;
        //     }
        // }

        // $product_models = Product_model::create([
        //     'sku' => $request->sku,
        //     'product_name' => $request->product_name,
        //     'product_detail' => $request->product_detail,
        //     'product_shortdetail' => $request->product_shortdetail,
        //     'product_brand' => $request->product_brand,
        //     'product_collection' => $request->product_collection,
        //     'product_type' => $request->product_type,
        //     'product_form' => $request->product_form,
        //     'product_package' => $request->product_package,
        //     'product_price' => $request->product_price,
        //     'product_price_currency' => $request->product_price_currency,
        //     'product_weight' => $request->product_weight,
        //     'product_width' => $request->product_width,
        //     'product_height' => $request->product_height,
        //     'product_length' => $request->product_length,
        //     'product_acidityscore' => $request->product_acidityscore,
        //     'product_aciditydesc' => $request->product_aciditydesc,
        //     'product_bodyscore' => $request->product_bodyscore,
        //     'product_bodydesc' => $request->product_bodydesc,
        //     'product_roastdesc' => $request->product_roastdesc,
        //     'product_typedesc' => $request->product_typedesc,
        //     'product_intensity' => $request->product_intensity,
        //     'fileimages' => $files,
        //     'status_stock' => $request->status_stock,
        //     'status' => $request->status
        // ]);

        // if ($product_models) {
        //     return redirect()
        //         ->route('products.index')
        //         ->with([
        //             'success' => 'New post has been created successfully'
        //         ]);
        // } else {
        //     return redirect()
        //         ->back()
        //         ->withInput()
        //         ->with([
        //             'error' => 'Some problem occurred, please try again'
        //         ]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $pict = [];
        // $images = DB::table('files')->where('files.id_product', '=', $id)->get();

        // for ($p = 0; $p < count($images); $p++) {
        //     $pct = $images[$p]->filenames;
        //     $fileimages = json_decode($images[$p]->filenames);

        //     for ($gimg = 0; $gimg < count($fileimages); $gimg++) {
        //         $imgs =  $fileimages[$gimg];
        //         array_push($pict, $imgs);
        //     }

        // }

        // $product_models = [];
        // $product_models_array = [];


        // $product_models_res =  DB::select('select pm.*, pcm.product_collection_name, ptm.product_type_name,
        //         pfm.product_form_name,
        //         ppm.product_package_name,
        //     (select discount_models.discount from discount_models
        //     LEFT JOIN discount_cluster_models as dcm on discount_models.discount_cluster_id = dcm.id
        //     where  (NOW() >= dcm.active_date AND NOW() <= dcm.off_date) and discount_models.product_id = pm.id
		// 				 )
		// 				as disc_event,
		// 				(select dcm.nama from discount_models
        //     LEFT JOIN discount_cluster_models as dcm on discount_models.discount_cluster_id = dcm.id
        //     where  (NOW() >= dcm.active_date AND NOW() <= dcm.off_date) and discount_models.product_id = pm.id
		// 				 )
		// 				as event_promo
        //     from product_models as pm
        //     LEFT JOIN product_collection_models as pcm on pcm.id = pm.product_collection
        //     LEFT JOIN product_type_models as ptm on ptm.id = pm.product_collection
        //     LEFT JOIN product_form_models as pfm on pfm.id = pm.product_collection
        //     LEFT JOIN product_package_models as ppm on ppm.id = pm.product_collection
        //     where pm.id =
        //     ' . $id);


        // $product_models_res =  DB::table('product_models')
        //     ->where('product_models.id', '=', $id)
        //     ->leftjoin(
        //         'product_collection_models',
        //         'product_models.product_collection',
        //         '=',
        //         'product_collection_models.id'
        //     )
        //     ->leftjoin(
        //         'product_type_models',
        //         'product_models.product_type',
        //         '=',
        //         'product_type_models.id'
        //     )
        //     ->leftjoin(
        //         'product_form_models',
        //         'product_models.product_form',
        //         '=',
        //         'product_form_models.id'
        //     )
        //     ->leftjoin(
        //         'product_package_models',
        //         'product_models.product_package',
        //         '=',
        //         'product_package_models.id'
        //     )

        //     ->select(
        //         'product_models.*',
        //         'product_collection_models.product_collection_name',
        //         'product_type_models.product_type_name',
        //         'product_form_models.product_form_name',
        //         'product_package_models.product_package_name'
        //     )
        //     ->get();


        // for ($p = 0; $p < count($product_models_res); $p++) {
        //     $prdct = $product_models_res[$p];
        //     $aciditydesc = explode("/", $product_models_res[$p]->product_aciditydesc);
        //     $bodydesc = explode("/", $product_models_res[$p]->product_bodydesc);
        //     $prdct->acidity_desc = $aciditydesc[0];
        //     $prdct->body_desc = $bodydesc[0];

        //     if (!empty($prdct->fileimages)) {
        //         $prdct->images = json_decode($product_models_res[$p]->fileimages);
        //     } else {
        //         $prdct->images = null;
        //     }


        //     if (!empty($prdct->disc_event)) {
        //         $prdct->product_price_after_disc =   ($prdct->product_price) - (($prdct->product_price) * ($prdct->disc_event) / 100);
        //     } else {
        //         $prdct->product_price_after_disc =  $prdct->product_price;
        //     }

        //     array_push($product_models_array, $prdct);
        // }

        // $product_models = $product_models_array[0];;
        // //dd($product_models);
        // // return view('posts.index', compact('posts'));
        // $title = 'test';
        // $pages = 'detail';
        // return view('front/detail-coffee', compact('product_models', 'title', 'pages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $product_collection_models =  DB::table('product_collection_models')->get();
        // $product_type_models =  DB::table('product_type_models')->get();
        // $product_form_models =  DB::table('product_form_models')->get();
        // $product_package_models =  DB::table('product_package_models')->get();

        // $product_models = Product_model::findOrFail($id);
        // $images = json_decode($product_models->fileimages);
        // //dd($images);
        // return view('products.edit', compact(
        //     'product_models',
        //     'product_collection_models',
        //     'product_type_models',
        //     'product_form_models',
        //     'product_package_models',
        //     'images'
        // ));
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
        //dd('test');
        // $this->validate($request, [
        //     'product_name' => 'required'
        // ]);


        // $product_models = Product_model::findOrFail($id);

        // $files = [];

        // if ($request->hasfile('filenames')) {
        //     foreach ($request->file('filenames') as $file) {
        //         //dd($file->getClientOriginalName());
        //         $name = $file->getClientOriginalName();
        //         $file->move(public_path('files/product-images'), $name);
        //         $files[] = $name;
        //     }
        //     //dd($files);

        //     $product_models->update([
        //         'sku' => $request->sku,
        //         'product_name' => $request->product_name,
        //         'product_detail' => $request->product_detail,
        //         'product_shortdetail' => $request->product_shortdetail,
        //         'product_brand' => $request->product_brand,
        //         'product_collection' => $request->product_collection,
        //         'product_type' => $request->product_type,
        //         'product_form' => $request->product_form,
        //         'product_package' => $request->product_package,
        //         'product_price' => $request->product_price,
        //         'product_price_currency' => $request->product_price_currency,
        //         'product_weight' => $request->product_weight,
        //         'product_width' => $request->product_width,
        //         'product_height' => $request->product_height,
        //         'product_length' => $request->product_length,
        //         'product_acidityscore' => $request->product_acidityscore,
        //         'product_aciditydesc' => $request->product_aciditydesc,
        //         'product_bodyscore' => $request->product_bodyscore,
        //         'product_bodydesc' => $request->product_bodydesc,
        //         'product_roastdesc' => $request->product_roastdesc,
        //         'product_typedesc' => $request->product_typedesc,
        //         'product_intensity' => $request->product_intensity,
        //         'fileimages' => $files,
        //         'status_stock' => $request->status_stock,
        //         'status' => $request->status
        //     ]);
        // } else {

        //     dd($files);

        //     $product_models->update([
        //         'sku' => $request->sku,
        //         'product_name' => $request->product_name,
        //         'product_detail' => $request->product_detail,
        //         'product_shortdetail' => $request->product_shortdetail,
        //         'product_brand' => $request->product_brand,
        //         'product_collection' => $request->product_collection,
        //         'product_type' => $request->product_type,
        //         'product_form' => $request->product_form,
        //         'product_package' => $request->product_package,
        //         'product_price' => $request->product_price,
        //         'product_price_currency' => $request->product_price_currency,
        //         'product_weight' => $request->product_weight,
        //         'product_width' => $request->product_width,
        //         'product_height' => $request->product_height,
        //         'product_length' => $request->product_length,
        //         'product_acidityscore' => $request->product_acidityscore,
        //         'product_aciditydesc' => $request->product_aciditydesc,
        //         'product_bodyscore' => $request->product_bodyscore,
        //         'product_bodydesc' => $request->product_bodydesc,
        //         'product_roastdesc' => $request->product_roastdesc,
        //         'product_typedesc' => $request->product_typedesc,
        //         'product_intensity' => $request->product_intensity,
        //         'status_stock' => $request->status_stock,
        //         'status' => $request->status
        //     ]);
        // }

        // if ($request->hasfile('filenames')) {
        //     foreach ($request->file('filenames') as $file) {
        //         $name = time() . rand(1, 100) . '.' . $file->extension();
        //         $file->move(public_path('files/product-images'), $name);
        //         $files[] = $name;
        //     }
        // }



        // if ($product_models) {
        //     return redirect()
        //         ->route('products.index')
        //         ->with([
        //             'success' => 'Post has been updated successfully'
        //         ]);
        // } else {
        //     return redirect()
        //         ->back()
        //         ->withInput()
        //         ->with([
        //             'error' => 'Some problem has occured, please try again'
        //         ]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // //
        // $product_models = Product_model::findOrFail($id);

        // $product_models->update([
        //     'deleted' => 'true',
        // ]);

        // return redirect()->route('products.index')
        //     ->with('success', 'Product Types deleted successfully');
    }
}
