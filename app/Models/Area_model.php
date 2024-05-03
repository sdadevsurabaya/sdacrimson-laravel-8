<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area_model extends Model
{
    use HasFactory;

    protected $table = 'area';
    protected $fillable = [
        'id',
        'area',
        'nama_area',
        'detail',
        'created_by',
        'created_date',
        'update_by',
        'update_date',
    ];
}
