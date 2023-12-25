<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunTenant extends Model
{
    use HasFactory;

    protected $table = 'akun_tenants';

    protected $fillable = [
        'nama_tenant', 'username_tenant', 'password_tenant',
    ];
}
