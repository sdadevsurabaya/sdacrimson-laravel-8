<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

DB::statement('ALTER TABLE areas CHANGE nama_wilayah nama_area VARCHAR(255) NOT NULL');
echo "Column renamed.\n";
