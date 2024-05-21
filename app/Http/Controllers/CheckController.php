<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use App\User;
use DataTables;
use Adrianorosa\GeoLocation\GeoLocation;

class CheckController extends Controller
{
    public function checkin(Request $request)
    {

     return view('check.checkin');

    }

    public function checkout(Request $request)
    {

     return view('check.checkout');

    }
}
