<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\User;
use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ReportSalesController extends Controller
{
    public function index(){
        return view('reportsales.index');
    }

}
