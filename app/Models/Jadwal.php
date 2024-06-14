<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'kode',
        'date',
        'created_by_id',
        'modified_by_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailJadwals()
    {
        return $this->hasMany(DetailJadwal::class);
    }

    public function laporanSales()
    {
        return $this->hasMany(LaporanSales::class, 'jadwal_id', 'id');
    }
}
