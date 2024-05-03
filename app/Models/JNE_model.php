<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JNE_model extends Model
{
    use HasFactory;

    protected $table = 'jne_api';
    protected $fillable = [
        'id',
        'dest_id',
        'country_name',
        'province_name',
        'city_name',
        'district_name',
        'subdidstrict_name',
        'zip_code',
        'dest_code',
        'orig_code',
        'dest_detail',
        'created_date',
        'update_time',
        'created_by',
        'update_date',
        'update_time',
        'update_by',
    ];
}
