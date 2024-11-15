<?php

use App\Http\Controllers\absenController;
use App\Http\Controllers\authController;
use App\Http\Controllers\ekskulController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\guruController;
use App\Http\Controllers\jurnalController;
use App\Http\Controllers\mapelController;
use App\Http\Controllers\orangtuaController;
use App\Http\Controllers\inputnilaiController;
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

Route::get('/subject', [mapelController::class, 'datamapel']);
Route::get('/addsubject', [mapelController::class, 'tambahmapel']);
Route::post('/storesubject', [mapelController::class, 'storesubject'])->name('store.subject');
Route::get('/editsubject', [mapelController::class, 'editmapel']);

Route::get('/parent', [orangtuaController::class, 'dataorangtua']);
Route::get('/addparent', [orangtuaController::class, 'tambahorangtua']);
Route::get('/editparent', [orangtuaController::class, 'editorangtua']);

Route::get('/extracurricular', [ekskulController::class, 'dataekskul']);
Route::get('/addextracurricular', [ekskulController::class, 'tambahekskul']);
Route::get('/editextracurricular', [ekskulController::class, 'editekskul']);

Route::get('/presence', [absenController::class, 'dataabsen']);
Route::get('/addpresence', [absenController::class, 'tambahabsen']);
Route::get('/editpresence', [absenController::class, 'editabsen']);

Route::get('/grade', [inputnilaiController::class, 'datanilai']);
Route::get('/addgrade', [inputnilaiController::class, 'tambahnilai']);
Route::get('/editgrade', [inputnilaiController::class, 'editnilai']);