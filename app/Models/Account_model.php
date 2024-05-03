<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account_model extends Model
{
    use HasFactory;

    protected $table = 'account';
    protected $fillable = [
        'id',
        'id_customer',
        'payment_trems',
        'id_price',
        'credit_limit',
        'max_nota',
        'bank',
        'atas_nama',
        'no_rek',
        'cabang',
        'status',
        'remarks',
        'ar',
        'created_date',
        'created_by',
        'update_date',
        'update_time',
        'update_by',
    ];
}
