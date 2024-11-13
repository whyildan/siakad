<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\siswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [authController::class, 'login']);
Route::get('/forgot_password', [authController::class, 'forgotpass']);
Route::get('/register', [authController::class, 'register']);

Route::get('/dashboard', [homeController::class, 'dashboard']);

Route::get('/datasiswa', [siswaController::class, 'datasiswa']);
Route::get('/tambahsiswa', [siswaController::class, 'tambahsiswa']);
Route::get('/editsiswa', [siswaController::class, 'editsiswa']);
