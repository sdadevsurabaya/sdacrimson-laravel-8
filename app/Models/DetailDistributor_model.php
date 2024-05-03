<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDistributor_model extends Model
{
    use HasFactory;

    protected $table = 'detail_customers';
    protected $fillable = [
        'id',
        'id_cust',
        'id_outlet',
        'brand',
        'status',
        'ar',
        'created_date',
        'created_by',
        'update_date',
        'update_time',
        'update_by',
    ];
}
