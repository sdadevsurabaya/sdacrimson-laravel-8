<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legal_model extends Model
{
    use HasFactory;

    protected $table = 'legal';
    protected $fillable = [
        'id',
        'id_customer',
        'tahun_berdiri',
        'no_siup',
        'no_tdp',
        'remarks',
        'ar',
        'status',
        'created_date',
        'created_by',
        'update_date',
        'update_time',
        'update_by',
    ];
}
