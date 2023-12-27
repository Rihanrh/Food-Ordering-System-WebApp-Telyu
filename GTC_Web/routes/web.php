<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunKasirController;
use App\Http\Controllers\AkunTenantController;
use App\Http\Controllers\MenuKasirController;
use App\Http\Controllers\MenuTenantController;
use App\Http\Controllers\PesananKasirController;
use App\Http\Controllers\PesananTenantController;  
use App\Http\Controllers\ReportKasirController;
use App\Http\Controllers\ReportTenantController;


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
Route::get('/kasir-login', [AkunKasirController::class, 'showLoginForm']);
Route::post('/kasir-login', [AkunKasirController::class, 'login'])->name('kasir.login');
Route::get('/kasir/confirm', [AkunKasirController::class, 'showConfirmPage'])->name('kasir.confirm');
Route::post('/kasir-keluar', [AkunKasirController::class, 'logout'])->name('kasir.keluar');

// Routes for Tenant
Route::get('/tenant-login', [AkunTenantController::class, 'showLoginForm']);
Route::post('/tenant-login', [AkunTenantController::class, 'login'])->name('tenant.login');
Route::post('/tenant-keluar', [AkunTenantController::class, 'logout'])->name('tenant.keluar');

//Route::get('/tenant/tenantMenu', [AkunTenantController::class, 'showMenuTenant'])->name('menuTenant.tenantMenu');


// Route::get('/', function () {
//     return view('tenantMenu');
// });
// Route::get('/', [MenuTenantController::class, 'index']);
Route::resource('/menuTenant', MenuTenantController::class);
Route::resource('/menuKasir', MenuKasirController::class);
Route::resource('/pesananKasir', PesananKasirController::class);
Route::resource('/pesananTenant', PesananTenantController::class);
Route::resource('/reportKasir', ReportKasirController::class);
