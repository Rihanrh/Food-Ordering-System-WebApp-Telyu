<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_tenants', function (Blueprint $table) {
            $table->id();
            $table->string('fotoProduk')->nullable();
            $table->string('namaProduk');
            $table->string('hargaProduk');
            $table->string('stokProduk');
            $table->timestamps();
            $table->foreignId('idTenant')->constrained('akun_tenants','id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_tenants');
    }

    
};