<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunPembeli extends Model
{
    use HasFactory;

    protected $table = 'akun_pembelis';

    protected $fillable = [
        'id', 'device_id'
    ];
}
