<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaCustomer extends Model
{
    use HasFactory;

    protected $table = 'areas';
    protected $fillable = [
        'kode_area',
        'nama_area',
        'kota',
        'deskripsi',
    ];
}
