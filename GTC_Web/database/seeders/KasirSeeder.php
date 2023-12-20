<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kasir;

class KasirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kasir::create([
            'nama_kasir' => 'Rihan',
            'username_kasir' => 'RihanDuit',
            'password_kasir' => bcrypt('money'),
        ]);
    }
}
