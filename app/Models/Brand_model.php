<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand_model extends Model
{
    use HasFactory;

    protected $table = 'brand';
    protected $fillable = [
        'id',
        'brand',
        'created_by',
        'created_date',
        'update_by',
        'update_date',
    ];
}
