<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\guruController;
use App\Http\Controllers\jurnalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [authController::class, 'login']);
Route::get('/forgot_password', [authController::class, 'forgotpass']);
Route::get('/register', [authController::class, 'register']);

Route::get('/dashboard', [homeController::class, 'dashboard']);

Route::get('/student', [siswaController::class, 'datasiswa']);
Route::get('/addstudent', [siswaController::class, 'tambahsiswa']);
Route::get('/editstudent', [siswaController::class, 'editsiswa']);

Route::get('/class', [kelasController::class, 'datakelas']);
Route::get('/addclass', [kelasController::class, 'tambahkelas']);
Route::get('/editclass', [kelasController::class, 'editkelas']);

Route::get('/teacher', [guruController::class, 'dataguru']);
Route::get('/addteacher', [guruController::class, 'tambahguru']);
Route::get('/editteacher', [guruController::class, 'editguru']);

Route::get('/journal', [jurnalController::class, 'datajurnal']);
Route::get('/addjournal', [jurnalController::class, 'tambahjurnal']);
Route::get('/editjournal', [jurnalController::class, 'editjurnal']);
