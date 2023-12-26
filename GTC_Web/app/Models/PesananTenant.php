<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananTenant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'pesanan_tenants';

    public function tenant(){
        return $this->belongsTo(AkunTenant::class,'id','idTenant');
    }

    public function menu(){
        return $this->hasMany(MenuTenant::class,'id','idMenu');
    }
}
