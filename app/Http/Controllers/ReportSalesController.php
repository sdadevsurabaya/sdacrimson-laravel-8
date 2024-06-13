<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\User;
use App\Models\Jadwal;
use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ReportSalesController extends Controller
{
    public function index(Request $request){

        $startDate = $request->start;
        $endDate = $request->end;
      
        $users = User::pluck('name', 'id');

        $hasRole = auth()->user()->hasRole('Sales');

        if( $hasRole){
            $jadwals = Jadwal::where('user_id', Auth::id())->orderBy('created_at','desc')->whereBetween('date', [$startDate, $endDate])->withTrashed()->whereNull('deleted_at')->get();
        }else {
            $jadwals = Jadwal::orderBy('created_at', 'desc')
            ->withTrashed()
            ->whereNull('deleted_at')
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        }
        return view('reportsales.index', compact('users', 'jadwals'));
    }

}
