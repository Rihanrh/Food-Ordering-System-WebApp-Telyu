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
        return $this->belongsTo(AkunTenant::class, 'idTenant', 'id');
    }

    public function menu(){
        return $this->belongsTo(MenuTenant::class,'idMenu','id');
    }

    protected $fillable = [
        'idTenant',
        'idMenu',
        'idPesanan',
        'quantity',
        'totalHarga',
        'metodePembayaran',
        'statusPesanan',
        'nomorMeja',
        'queue',
        'idPembeli',
    ];
}