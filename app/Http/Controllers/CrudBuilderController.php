<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudBuilderController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function index(Request $request)
    {
    dd($_SERVER);
    $myfile = fopen("App/Http/Controllers/newfile.txt", "w") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
fclose($myfile);
    }
}
