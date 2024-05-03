<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRole;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class HomeController extends Controller
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
        $user = Auth::user();
        // dd($request->path());
        //dd($user->hasRole('member'));
        if ($user->hasRole('Admin')) {
            return redirect('/admin/dashboard');
            // return redirect('/');
            // if (view()->exists($request->path())) {
            //     return view($request->path());
            // }
        } else if ($user->hasRole('Sales')) {
            return redirect('/admin/dashboard');
            // if (view()->exists($request->path())) {
            //     return view($request->path());
            // }
        } else if ($user->hasRole('Verifikator')) {
            return redirect('/admin/dashboard');
            // if (view()->exists($request->path())) {
            //     return view($request->path());
            // }
        }



        return abort(404);
    }

    public function root()
    {
        // return view('index');
        return view('dashboard.index');
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function FormSubmit(Request $request)
    {
        return view('form-repeater');
    }

    public function loadslider()
    {
        return 'Load Slider';
    }
}
