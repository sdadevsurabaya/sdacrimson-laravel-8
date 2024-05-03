<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOutlet_model extends Model
{
    use HasFactory;

    protected $table = 'type_outlet';
    protected $fillable = [
        'id',
        'type_outlet',
        'created_by',
        'created_date',
        'update_by',
        'update_date',
    ];
}
