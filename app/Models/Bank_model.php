<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank_model extends Model
{
    use HasFactory;

    protected $table = 'bank';
    protected $fillable = [
        'id',
        'bank',
        'created_by',
        'created_date',
        'update_by',
        'update_date',
    ];
}
