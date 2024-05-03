<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPerson_model extends Model
{
    use HasFactory;

    protected $table = 'contact_person';
    protected $fillable = [
        'id',
        'id_outlet',
        'nama_lengkap',
        'no_telpon',
        'email',
        'jabatan',
        'status',
        'ar',
        'created_date',
        'created_by',
        'update_date',
        'update_time',
        'update_by',
    ];
}
