<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AkunKasir;

class KasirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AkunKasir::create([
            'nama_kasir' => 'Rihan',
            'username_kasir' => 'rihan_kasir',
            'password_kasir' => bcrypt('test'),
        ]);
    }
}
