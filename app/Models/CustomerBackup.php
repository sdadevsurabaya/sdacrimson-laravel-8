<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBackup extends Model
{
    use HasFactory;

    protected $table = 'customer_backup';

    protected $guarded = ['id'];
    
}
