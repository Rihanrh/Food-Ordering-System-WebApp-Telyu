<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/kasir-login', function () {
    return view('login_kasir');
});

Route::get('/tenant-login', function () {
    return view('login_tenant');
});
