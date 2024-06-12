<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailJadwal extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(General_model::class, 'general_id' ,'id');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function generalInformation()
    {
        return $this->belongsTo(General_model::class, 'general_id');
    }
}
