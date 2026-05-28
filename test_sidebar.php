<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

auth()->loginUsingId(36);
echo "User ID: " . auth()->id() . "\n";
echo "Roles: " . json_encode(auth()->user()->roles->pluck('name')) . "\n";
echo "Has Admin: " . (auth()->user()->hasRole('Admin') ? 'Yes' : 'No') . "\n";
echo "Has Manager Sales: " . (auth()->user()->hasRole('Manager Sales') ? 'Yes' : 'No') . "\n";
echo "Has Toko: " . (auth()->user()->hasRole('Toko') ? 'Yes' : 'No') . "\n";
echo "Has Any Role test: " . (auth()->user()->hasAnyRole(['Admin', 'Manager Sales', 'Toko']) ? 'Yes' : 'No') . "\n";

use Illuminate\Support\Facades\Blade;
$str = "@hasanyrole('Admin|Manager Sales|Toko') FOUND @else NOT_FOUND @endhasanyrole";
echo Blade::render($str);

