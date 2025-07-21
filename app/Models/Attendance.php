<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * [TAMBAHKAN INI]
     * Relasi untuk mengambil informasi customer/usaha.
     */
    public function generalInformation()
    {
        return $this->belongsTo(General_model::class, 'general_id', 'id');
    }
}
