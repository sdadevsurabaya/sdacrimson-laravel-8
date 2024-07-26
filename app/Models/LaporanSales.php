<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanSales extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function gambar()
    {
        return $this->hasMany(LaporanFoto::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id');
    }
    public function detailJadwal()
    {
        return $this->hasMany(DetailJadwal::class, 'jadwal_id', 'jadwal_id');
    }
    

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'general_id', 'general_id');
    }
    
    public function jarak()
    {
        return $this->hasMany(Jarak::class, 'general_id', 'general_id');
    }
    



    public function general()
    {
        return $this->belongsTo(General_model::class, 'general_id', 'id');
    }
}
