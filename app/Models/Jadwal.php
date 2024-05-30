<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'kode',
        'date',
        'created_by_id',
        'modified_by_id',
    ];
}
