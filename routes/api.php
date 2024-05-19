<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/tenants', [App\Http\Controllers\AkunTenantController::class, 'getAllTenants']);
Route::get('/tenants/{idTenant}', [App\Http\Controllers\AkunTenantController::class, 'getTenant']);
Route::get('/getMenuByTenant/{tenantName}', [App\Http\Controllers\MenuTenantController::class, 'getMenuByTenant']);
Route::get('/getMenuById/{idTenant}/{id}', [App\Http\Controllers\MenuTenantController::class, 'getMenuById']);

Route::get('/pembelis/{deviceId}', [App\Http\Controllers\AkunPembeliController::class, 'getPembeli']);
Route::post('/pembelis', [App\Http\Controllers\AkunPembeliController::class, 'createPembeli']);

Route::get('/checkout-items/{idPembeli}', [App\Http\Controllers\AkunPembeliController::class, 'getCheckoutItems']);
Route::post('/checkout-items', [CheckoutTenantController::class, 'storeCheckoutItem']);

Route::post('/pesanan', [PesananTenantController::class, 'postPesanan']);