<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_model extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = [
        'id',
        'name',
        'guard_name',
    ];

}
