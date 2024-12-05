<?php

use App\Http\Controllers\absenController;
use App\Http\Controllers\authController;
use App\Http\Controllers\ekskulController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\mappingKelasController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\guruController;
use App\Http\Controllers\jurnalController;
use App\Http\Controllers\mapelController;
use App\Http\Controllers\orangtuaController;
use App\Http\Controllers\inputnilaiController;
use App\Http\Controllers\mappingMapelController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

Route::get('/', [authController::class, 'main']);

//akses sebelum login
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [authController::class, 'login'])->name('login');
    Route::post('/login/auth', [authController::class, 'authenticate']);
});

//akses setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [authController::class, 'logout']);
    Route::get('/dashboard', [homeController::class, 'dashboard']);
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    $apiv1 = 'api/v1/';

    Route::get('/adduser', [userController::class, 'tambahuser']);
    Route::post('/createuser', action: [userController::class, 'createuser']);
    Route::get('/user', [userController::class, 'datauser']);
    Route::get('/edituser/{id}', [userController::class, 'edituser']);
    Route::post('/updateuser/{id}', [userController::class, 'updateuser']);
    Route::get('/deleteuser/{id}', [userController::class, 'deleteuser']);

    Route::get('/map/classes', [mappingKelasController::class, 'index']);
    Route::get('/map/classes/{id}', [mappingKelasController::class, 'detailMapping']);
    // Route for API classes mapping
    Route::post($apiv1 . 'map/class', [mappingKelasController::class, 'insertMapping']);
    Route::get($apiv1 . 'map/students', [mappingKelasController::class, 'getStudentsMap']);
});


Route::middleware(['auth', 'role:admin,guru'])->group(function () {
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
});

Route::middleware(['auth', 'role:admin,guru,orang_tua'])->group(function () {});
