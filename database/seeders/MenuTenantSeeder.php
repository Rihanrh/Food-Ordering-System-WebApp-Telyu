<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuTenant;

class MenuTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuTenant::create([
            'namaProduk' => 'Nasi Kuning',
            'hargaProduk' => '13000',
            'fotoProduk' => 'Untuk Diupload/Tenant Dina/Nasi Kuning.jpg',
            'idTenant' => 1, 
        ]);

        MenuTenant::create([
            'namaProduk' => 'Sate Ayam',
            'hargaProduk' => '12000',
            'fotoProduk' => 'Untuk Diupload/Tenant Dina/Sate Ayam.jpg',
            'idTenant' => 1,
        ]);

        MenuTenant::create([
            'namaProduk' => 'Seblak',
            'hargaProduk' => '15000',
            'fotoProduk' => 'Untuk Diupload/Tenant Dina/Seblak.jpg',
            'idTenant' => 1, 
        ]);

        MenuTenant::create([
            'namaProduk' => 'Mie Goreng',
            'hargaProduk' => '11000',
            'fotoProduk' => 'Untuk Diupload/Tenant Lia/Mie Goreng.jpg',
            'idTenant' => 2, 
        ]);

        MenuTenant::create([
            'namaProduk' => 'Chicken Katsu',
            'hargaProduk' => '15000',
            'fotoProduk' => 'Untuk Diupload/Tenant Lia/Chicken Katsu.jpg',
            'idTenant' => 2, 
        ]);

        // MenuTenant::create([
        //     'namaProduk' => 'Nasi Goreng',
        //     'hargaProduk' => '16000',
        //     'fotoProduk' => 'Untuk Diupload/Tenant Lia/Nasi Goreng.jpg',
        //     'idTenant' => 2, 
        // ]);

        // MenuTenant::create([
        //     'namaProduk' => 'Soto Ayam',
        //     'hargaProduk' => '12000',
        //     'fotoProduk' => 'Untuk Diupload/Tenant Lia/Soto Ayam.jpg',
        //     'idTenant' => 2, 
        // ]);

        // MenuTenant::create([
        //     'namaProduk' => 'Ayam Gulai',
        //     'hargaProduk' => '14000',
        //     'fotoProduk' => 'Untuk Diupload/Tenant Fariz/Ayam Gulai.jpg',
        //     'idTenant' => 3, 
        // ]);

        MenuTenant::create([
            'namaProduk' => 'Es teh',
            'hargaProduk' => '4000',
            'fotoProduk' => 'Untuk Diupload/Tenant Fariz/Es teh.jpg',
            'idTenant' => 3, 
        ]);

        MenuTenant::create([
            'namaProduk' => 'Kerupuk',
            'hargaProduk' => '2000',
            'fotoProduk' => 'Untuk Diupload/Tenant Fariz/Kerupuk.jpg',
            'idTenant' => 3, 
        ]);

        // MenuTenant::create([
        //     'namaProduk' => 'Nasi',
        //     'hargaProduk' => '4000',
        //     'fotoProduk' => 'Untuk Diupload/Tenant Fariz/Nasi.jpg',
        //     'idTenant' => 3, 
        // ]);

        // MenuTenant::create([
        //     'namaProduk' => 'Rendang',
        //     'hargaProduk' => '14000',
        //     'fotoProduk' => 'Untuk Diupload/Tenant Fariz/Rendang.jpg',
        //     'idTenant' => 3, 
        // ]);

        MenuTenant::create([
            'namaProduk' => 'Batagor',
            'hargaProduk' => '12000',
            'fotoProduk' => 'Untuk Diupload/Tenant Liyan/Batagor.jpg',
            'idTenant' => 4, 
        ]);

        MenuTenant::create([
            'namaProduk' => 'Bubur Ayam',
            'hargaProduk' => '10000',
            'fotoProduk' => 'Untuk Diupload/Tenant Liyan/Bubur Ayam.jpg',
            'idTenant' => 4, 
        ]);

        // MenuTenant::create([
        //     'namaProduk' => 'Nasi Uduk Lengkap',
        //     'hargaProduk' => '16000',
        //     'fotoProduk' => 'Untuk Diupload/Tenant Liyan/Nasi Uduk Lengkap.jpg',
        //     'idTenant' => 4, 
        // ]);
    }
}
