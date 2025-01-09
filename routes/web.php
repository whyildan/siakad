<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\extraController;
use App\Http\Controllers\gradeController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\journalController;
use App\Http\Controllers\mappingClassController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\classController;
use App\Http\Controllers\teacherController;
use App\Http\Controllers\subjectController;
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

    // Classes mappings
    Route::get('/map/classes', [mappingClassController::class, 'index']);
    Route::get('/map/classes/{id}', [mappingClassController::class, 'detailMapping']);
    // Route for API classes mapping
    Route::post($apiv1 . 'map/class', [mappingClassController::class, 'insertMapping']);
    Route::get($apiv1 . 'map/students', [mappingClassController::class, 'getStudentsMap']);

    // Route for subject mapping
    Route::get('map/subjects', [subjectController::class, 'mapping']);
    Route::get('map/subject/{id}', [subjectController::class, 'detailMapping']);
    // Route for API subject mapping
    Route::post($apiv1 . 'map/subject', [subjectController::class, 'insertMapping']);
    Route::get($apiv1 . 'map/subjects', [subjectController::class, 'getSubjects']);
    Route::get($apiv1 . 'map/subject_teachers', [subjectController::class, 'getTeachers']);
    Route::post($apiv1 . 'map/subject/import', [subjectController::class, 'import'])->name('schedule.import');

    // Route for classes journal
    Route::get('classes', [classController::class, 'main']);
    Route::get('classes/journal/{id}', [journalController::class, 'journal']);
    Route::get('classes/journal/grades/{id}', [journalController::class, 'journalGrade']);
    Route::get('classes/journal/export/{id}', [journalController::class, 'journalExport']);
    Route::get($apiv1 . 'journals', [journalController::class, 'get'])->name('api.get-journals');
    Route::post($apiv1 . 'journal', [journalController::class, 'insert'])->name('api.insert-journals');
    Route::delete($apiv1 . 'journal/{id}', [journalController::class, 'destroy']);

    Route::get($apiv1 . 'journal/{journal}/attendance', [journalController::class, 'getAttendance']);
    Route::post($apiv1 . 'journal/{journal}/attendance', [journalController::class, 'saveAttendance']);

    Route::post($apiv1 . 'save-grades/{classSubjectId}', [journalController::class, 'saveGrades'])->name('grades.save');

    Route::get('grades/project/{classSubjectId}', [gradeController::class, 'projectGrade'])->name('grade.project');
    Route::get('grades/formative/{classSubjectId}', [gradeController::class, 'formativeGrade'])->name('grade.formative');
    Route::get('grades/summative/{classSubjectId}', [gradeController::class, 'summativeGrade'])->name('grade.summative');
    Route::get('grades/view/{classSubjectId}', [gradeController::class, 'viewGrade'])->name('grade.view');
    Route::post('grades', [gradeController::class, 'saveGrades'])->name('grade.save');
    // Route to fetch grades based on semester
    Route::get($apiv1 . 'fetch-grades/{classSubjectId}', [JournalController::class, 'fetchGrades'])->name('grades.fetch');
});


Route::middleware(['auth', 'role:admin,guru'])->group(function () {
    Route::get('/student', [studentController::class, 'datasiswa']);
    Route::get('/addstudent', [studentController::class, 'tambahsiswa']);
    Route::post('/createstudent', [studentController::class, 'createstudent']);
    Route::get('/editstudent/{id}', [studentController::class, 'editsiswa']);
    Route::post('/updatestudent/{id}', [studentController::class, 'updatestudent']);
    Route::get('/deletestudent/{id}', [studentController::class, 'deletestudent']);

    Route::get('/class', [classController::class, 'datakelas']);
    Route::get('/addclass', [classController::class, 'tambahkelas']);
    Route::post('/createclass', [classController::class, 'createclass']);
    Route::get('/editclass/{id}', [classController::class, 'editkelas']);
    Route::post('/updateclass/{id}', [classController::class, 'updateclass']);
    Route::get('/deleteclass/{id}', [classController::class, 'deleteclass']);

    Route::get('/teacher', [teacherController::class, 'dataguru']);
    Route::get('/addteacher', [teacherController::class, 'tambahguru']);
    Route::post('/createteacher', [teacherController::class, 'createteacher']);
    Route::get('/editteacher/{id}', [teacherController::class, 'editguru']);
    Route::post('/updateteacher/{id}', [teacherController::class, 'updateteacher']);
    Route::get('/deleteteacher/{id}', [teacherController::class, 'hapusguru']);

    Route::get('/subject', [subjectController::class, 'datamapel']);
    Route::get('/addsubject', [subjectController::class, 'tambahmapel']);
    Route::post('/storesubject', [subjectController::class, 'storesubject']);
    Route::get('/editsubject/{id}', [subjectController::class, 'editmapel']);
    Route::post('/updatesubject/{id}', [subjectController::class, 'updatesubject']);
    Route::get('/deletesubject/{id}', [subjectController::class, 'hapusmapel']);

    Route::get('/extracurricular', [extraController::class, 'dataekskul']);
    Route::get('/addextracurricular', [extraController::class, 'tambahekskul']);
    Route::post('/createextracurricular', [extraController::class, 'createextra']);
    Route::get('/editextracurricular/{id}', [extraController::class, 'editekskul']);
    Route::post('/updateextracurricular/{id}', [extraController::class, 'updateextra']);
    Route::get('/deleteextracurricular/{id}', [extraController::class, 'deleteextra']);
});
