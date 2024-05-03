<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General_model extends Model
{
    use HasFactory;

    protected $table = 'general_informations';
    protected $fillable = [
        'id',
        'id_customer',
        'id_customer_draf',
        'type_usaha',
        'nama_usaha',
        'nama_lengkap',
        'alamat_kantor',
        'jabatan',
        'telepon',
        'mobile_phone',
        'email',
        'web_site',
        'no_npwp',
        'nama_npwp',
        'alamat_npwp',
        'nik',
        'ar',
        'created_date',
        'created_by',
        'update_date',
        'update_time',
        'update_by',
    ];
}
