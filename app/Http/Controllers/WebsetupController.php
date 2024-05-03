<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;

use App\Models\Order_model;
use App\Models\Order_detail_model;
use App\Models\Product_model;
use App\Models\Product_collection_model;
use App\Models\Product_type_model;
use App\Models\Product_form_model;
use App\Models\Product_package_model;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class WebsetupController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $datasetup = DB::select("select * from setting");  
        if(count($datasetup)<>0)
        {
           
        $site_name=$datasetup[0]->site_name;
        $site_detail=$datasetup[0]->site_detail;
        $site_type=$datasetup[0]->site_type;
        $site_currency=$datasetup[0]->site_currency;

        $site_logo_front = $datasetup[0]->site_logo_front;
        $site_logo_admin = $datasetup[0]->site_logo_admin;
        
        $stripe_screet_key=$datasetup[0]->stripe_screet_key;
        $stripe_publishable_key=$datasetup[0]->stripe_publishable_key;
        $stripe_webhook_screet=$datasetup[0]->stripe_webhook_screet;
        $domain=$datasetup[0]->domain;
        $price=$datasetup[0]->price;  
        $gst=$datasetup[0]->gst;
        }
        else
        {
        $site_name=null;
        $site_detail=null;
        $site_type=null;
        $site_currency=null;

        $site_logo_front = null;
        $site_logo_admin = null;
        
        $stripe_screet_key=null;
        $stripe_publishable_key=null;
        $stripe_webhook_screet=null;
        $domain=null;
        $price=null;
        $gst=null;
        }
        

        
        
        return view('setting.index',compact('site_name','site_detail','site_type','site_currency','site_logo_front','site_logo_admin','stripe_screet_key','stripe_publishable_key','stripe_webhook_screet','domain','price', 'gst'));
    }
    public function store(Request $request)
    {

        dump($request->site_name);
        dump($request->site_detail);
        dump($request->site_type);
        dump($request->site_currency);

        dump($request->site_logo_front);
        dump($request->site_logo_admin);
        

        dump($request->stripe_screet_key);
        dump($request->stripe_publishable_key);
        dump($request->stripe_webhook_secret);
        dump($request->domain);
        dump($request->price);

        // dd("test");

        $site_name=$request->site_name;
        $site_detail=$request->site_detail;
        $site_type=$request->site_type;
        $site_currency=$request->site_currency;

        $site_logo_front = $request->site_logo_front;
        $site_logo_admin = $request->site_logo_admin;
        

        $stripe_screet_key=$request->stripe_screet_key;
        $stripe_publishable_key=$request->stripe_publishable_key;
        $stripe_webhook_screet=$request->stripe_webhook_screet;
        $domain=$request->domain;
        $price=$request->price;
        $gst=$request->gst;
      
        
        $count = DB::select("select count(*) as countdata from setting");        
        if($count[0]->countdata==0)
        {
            $setting = DB::insert("insert into setting (site_name,site_detail,site_type,site_currency,site_logo_front,site_logo_admin,stripe_screet_key,stripe_publishable_key,stripe_webhook_screet,domain,price, gst) values ('$site_name','$site_detail',' $site_type','$site_currency',' $site_logo_front',' $site_logo_admin','$stripe_screet_key','$stripe_publishable_key','$stripe_webhook_screet','$domain','$price','$gst')");
        }
        else
        {
            $setting = DB::update("update setting set site_name = '".$site_name."' ,site_detail = '".$site_detail."' ,site_type = '".$site_type."' ,site_currency = '".$site_currency."' ,site_logo_front = '".$site_logo_front."' ,site_logo_admin = '".$site_logo_admin."' ,stripe_screet_key = '".$stripe_screet_key."' ,stripe_publishable_key = '".$stripe_publishable_key."' ,stripe_webhook_screet = '".$stripe_webhook_screet."' ,domain = '".$domain."' ,price = '".$price."' ,gst = '".$gst."'");

        }

        if ($setting) {
            return redirect()
                ->route('websetup.index')
                ->with([
                    'success' => 'New post has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
        
        //return view('setting.index');
    }
}
