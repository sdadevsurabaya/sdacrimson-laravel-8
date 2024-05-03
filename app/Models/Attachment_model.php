<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment_model extends Model
{
    use HasFactory;

    protected $table = 'attachment';
    protected $fillable = [
        'id',
        'id_customer',
        'files',
        'nama_files',
        'ar',
        'created_date',
        'created_by',
        'update_date',
        'update_time',
        'update_by',
    ];
}
