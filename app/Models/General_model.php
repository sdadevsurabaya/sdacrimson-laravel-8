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


    // Tambahan di Model GeneralInformation
public function detailJadwals()
{
    return $this->hasMany(DetailJadwal::class, 'general_id', 'id');
}

public function jadwals()
{
    return $this->hasManyThrough(Jadwal::class, DetailJadwal::class, 'general_id', 'id', 'id', 'jadwal_id')
                ->select('jadwals.id as jadwal_id', 'jadwals.user_id', 'jadwals.date', 'jadwals.created_by_id');
}

public function laporanSales()
{
    return $this->hasMany(LaporanSales::class, 'general_id', 'id');
}

}
