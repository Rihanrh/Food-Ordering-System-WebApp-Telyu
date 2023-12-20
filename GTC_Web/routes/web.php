<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\KasirController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landpg');
});

// Routes for Kasir
Route::get('/kasir-login', [KasirController::class, 'showLoginForm']);
Route::post('/kasir-login', [KasirController::class, 'login'])->name('kasir.login');
Route::get('/kasir/confirm', [KasirController::class, 'showConfirmPage'])->name('kasir.confirm');

// Routes for Tenant
Route::get('/tenant-login', [TenantController::class, 'showLoginForm']);
Route::post('/tenant-login', [TenantController::class, 'login'])->name('tenant.login');
Route::get('/tenant/tenantListPesanan', [TenantController::class, 'showTenantListPesanan'])->name('tenant.tenantListPesanan');
