<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet_model extends Model
{
    use HasFactory;

    protected $table = 'outlet';
    protected $fillable = [
        'id',
        'id_outlet',
        'id_customer',
        'nama_outlet',
        'address_type',
        'outlet_type',
        'id_area',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'lat',
        'long',
        'latitude',
        'longitude',
        'foto_outlet',
        'nama_foto',
        'status',
        'brand',
        'aplikasi',
        'jumlah_pengambilan',
        'remarks',
        'ar',
        'status_generate_qrcode',
        'created_date',
        'update_time',
        'created_by',
        'update_date',
        'update_time',
        'update_by',
    ];

    public function Image()
    {
        return $this->hasMany(ImagesOutlet_model::class, 'id_outlet', 'id');
    }
    public function Distributor()
    {
        return $this->hasMany(DetailDistributor_model::class, 'id_outlet', 'id_outlet');
    }
}
