<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuTenant extends Model
{
    use HasFactory;
    protected $fillable = [
        "fotoProduk",
        "namaProduk",
        "HargaProduk"
    ];

    protected $table = 'menu_tenants';
    
    public function tenant(){
        return $this->belongsTo(AkunTenant::class,'id','idTenant');
    }

}
