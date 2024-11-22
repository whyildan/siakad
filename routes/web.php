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
use App\Http\Controllers\mappingMapelController;
use App\Http\Controllers\resetPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [authController::class, 'login']);
Route::post('/login/auth', [authController::class, 'authenticate']);
Route::get('/logout', [authController::class, 'logout']);
Route::get('/register', [authController::class, 'register']);

Route::get('/forgot_password', [resetPasswordController::class, 'resetpassword']);
Route::post('/forgot_password', [resetPasswordController::class, 'sendResetLink']);

Route::get('/dashboard', [homeController::class, 'dashboard']);

Route::get('/student', [siswaController::class, 'datasiswa']);
Route::get('/addstudent', [siswaController::class, 'tambahsiswa']);
Route::post('/createstudent', [siswaController::class, 'createstudent']);
Route::get('/editstudent/{id}', [siswaController::class, 'editsiswa']);
Route::post('/updatestudent/{id}', [siswaController::class, 'updatestudent']);
Route::get('/deletestudent/{id}', [siswaController::class, 'deletestudent']);

Route::get('/class', [kelasController::class, 'datakelas']);
Route::get('/addclass', [kelasController::class, 'tambahkelas']);
Route::post('/createclass', [kelasController::class, 'createclass']);
Route::get('/editclass/{id}', [kelasController::class, 'editkelas']);
Route::post('/updateclass/{id}', [kelasController::class, 'updateclass']);
Route::get('/deleteclass/{id}', [kelasController::class, 'deleteclass']);

Route::get('/teacher', [guruController::class, 'dataguru']);
Route::get('/addteacher', [guruController::class, 'tambahguru']);
Route::post('/createteacher', [guruController::class, 'createteacher']);
Route::get('/editteacher/{id}', [guruController::class, 'editguru']);
Route::post('/updateteacher/{id}', [guruController::class, 'updateteacher']);
Route::get('/deleteteacher/{id}', [guruController::class, 'hapusguru']);


Route::get('/subject', [mapelController::class, 'datamapel']);
Route::get('/addsubject', [mapelController::class, 'tambahmapel']);
Route::post('/storesubject', [mapelController::class, 'storesubject']);
Route::get('/editsubject/{id}', [mapelController::class, 'editmapel']);
Route::post('/updatesubject/{id}', [mapelController::class, 'updatesubject']);
Route::get('/deletesubject/{id}', [mapelController::class, 'hapusmapel']);

Route::get('/mapping/subject', [mappingMapelController::class, 'mappingmapel']);
Route::get('/addmapping/subject', [mappingMapelController::class, 'tambahmapping']);
Route::post('/createmapping/subject', [mappingMapelController::class, 'createmapping']);
Route::get('/editmapping/subject/{id}', [mappingMapelController::class, 'editmapping']);
Route::post('/updatemapping/subject/{id}', [mappingMapelController::class, 'updatemapping']);
Route::get('/deletemapping/subject/{id}', [mappingMapelController::class, 'deletemapping']);

Route::get('/parent', [orangtuaController::class, 'dataorangtua']);
Route::get('/addparent', [orangtuaController::class, 'tambahorangtua']);
Route::post('/createparent', [orangtuaController::class, 'createparent']);
Route::get('/editparent/{id}', [orangtuaController::class, 'editorangtua']);
Route::post('/updateparent/{id}', [orangtuaController::class, 'updateparent']);
Route::get('/deleteparent/{id}', [orangtuaController::class, 'deleteparent']);

Route::get('/extracurricular', [ekskulController::class, 'dataekskul']);
Route::get('/addextracurricular', [ekskulController::class, 'tambahekskul']);
Route::post('/createextracurricular', [ekskulController::class, 'createextra']);
Route::get('/editextracurricular/{id}', [ekskulController::class, 'editekskul']);
Route::post('/updateextracurricular/{id}', [ekskulController::class, 'updateextra']);
Route::get('/deleteextracurricular/{id}', [ekskulController::class, 'deleteextra']);

Route::get('/journal', [jurnalController::class, 'datajurnal']);
Route::get('/addjournal', [jurnalController::class, 'tambahjurnal']);
Route::post('/createjournal', [jurnalController::class, 'createjournal']);
Route::get('/editjournal/{id}', [jurnalController::class, 'editjurnal']);
Route::post('/updatejournal/{id}', [jurnalController::class, 'updatejournal']);
Route::get('/deletejournal/{id}', [jurnalController::class, 'deletejournal']);

Route::get('/journal/presence/{id}', [absenController::class, 'dataabsen']);
Route::get('/addpresence', [absenController::class, 'tambahabsen']);
Route::get('/editpresence', [absenController::class, 'editabsen']);


Route::get('/grade', [inputnilaiController::class, 'datanilai']);
Route::get('/addgrade', [inputnilaiController::class, 'tambahnilai']);
Route::get('/editgrade', [inputnilaiController::class, 'editnilai']);
