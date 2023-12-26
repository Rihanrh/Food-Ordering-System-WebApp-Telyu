<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AkunTenant extends Authenticatable
{
    use HasFactory;

    protected $table = 'akun_tenants';

    protected $fillable = [
        'nama_tenant', 'username_tenant', 'password_tenant',
    ];

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password_tenant;
    }
}
