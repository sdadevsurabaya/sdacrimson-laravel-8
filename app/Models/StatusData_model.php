<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusData_model extends Model
{
    use HasFactory;

    protected $table = 'status_data';
    protected $fillable = [
        'id_customer',
        'status_data',
        'remarks',
        'id_user_validator',
        'created_date',
        'created_time',
        'created_by',
        'update_date',
        'update_time',
        'update_by',
    ];
}
