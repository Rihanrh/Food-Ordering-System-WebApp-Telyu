<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AkunTenant;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AkunTenant::create([
            'nama_tenant' => 'test',
            'username_tenant' => 'test',
            'password_tenant' => bcrypt('test1'),
        ]);
        AkunTenant::create([
            'nama_tenant' => 'Lia',
            'username_tenant' => 'lia_tenant',
            'password_tenant' => bcrypt('test'),
        ]);
        AkunTenant::create([
            'nama_tenant' => 'Fariz',
            'username_tenant' => 'fariz_tenant',
            'password_tenant' => bcrypt('test'),
        ]);
    }
}
