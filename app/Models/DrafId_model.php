<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrafId_model extends Model
{
    use HasFactory;

    protected $table = 'draft_id';
    protected $fillable = [
        'id',
        'id_customer',
        'id_outlet',
        'nama_usaha',
        'alamat_kantor',
        'nama_lengkap',
        'mobile_phone',
        'email',
    ];
}
