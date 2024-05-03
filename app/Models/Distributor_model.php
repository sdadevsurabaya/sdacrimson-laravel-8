<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor_model extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'id',
        'id_cust',
        'type_usaha',
        'nama_cust',
        'address_type',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'latitude',
        'longtitude',
        'created_by',
        'created_date',
        'update_by',
        'update_date',
    ];
}
