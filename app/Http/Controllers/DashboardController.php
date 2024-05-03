<?php
/**
 * author : Suryo Atmojo <suryoatm@gmail.com>
 * project : Supresso Laravel
 * Start-date : 19-09-2022
 */

namespace App\Http\Controllers;

use App\Models\General_model;
use App\Models\Legal_model;
use App\Models\ContactPerson_model;
use App\Models\Outlet_model;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $id_user = Auth::user()->id ;
        if (Auth::user()->hasRole("Sales") ) {
            // dd("Sales " . $id_user);
            $get_general = General_model::where('ar', $id_user)->get();

            $get_legal = Legal_model::where('ar', $id_user)->get();

            $get_kontak = ContactPerson_model::where('ar', $id_user)->get();

            $get_outlet = Outlet_model::where('ar', $id_user)->get();
        } else {
            // dd("buklan sales");
            $get_general = General_model::all();

            $get_legal = Legal_model::all();

            $get_kontak = ContactPerson_model::all();

            $get_outlet = Outlet_model::all();
        }

        return view('dashboard.index',compact('get_general', 'get_legal', 'get_kontak', 'get_outlet'));
    }
}
