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
        Schema::create('pesanan_tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idTenant')->constrained('akun_tenants', 'id')->onDelete('cascade');
            $table->foreignId('idMenu')->constrained('menu_tenants', 'id')->onDelete('cascade');
            $table->bigInteger('idPesanan');
            $table->integer('quantity');
            $table->integer('totalHarga');
            $table->string('metodePembayaran');
            $table->string('statusPesanan');
            $table->integer('nomorMeja');
            $table->string('opsiKonsumsi');
            $table->unsignedInteger('queue')->nullable();
            $table->foreignId('idPembeli')->nullable()->constrained('akun_pembelis', 'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_tenants');
    }
};