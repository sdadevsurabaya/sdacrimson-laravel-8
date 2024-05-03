<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesOutlet_model extends Model
{
    use HasFactory;

    protected $table = 'images_outlet';
    protected $fillable = [
        'id',
        'id_outlet',
        'foto',
        'nama_foto',
    ];
}
