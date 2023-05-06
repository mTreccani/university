<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['login'=>true, 'logout'=>true]);

Route::controller(StudentController::class)->prefix('student')->group(function () {
    Route::get('/', 'goToDashboard')->name('student.dashboard');
    Route::get('/career', 'goToCareer')->name('student.career');
    Route::get('/exams', 'goToExams')->name('student.exams');
    Route::get('/courses/{id}', 'goToCourse')->name('student.course');
});

Route::controller(TeacherController::class)->prefix('teacher')->group(function () {
    Route::get('/', 'goToDashboard')->name('teacher.dashboard');
    Route::get('/exam', 'goToCreateExam')->name('teacher.exam');
    Route::get('/exam/{id}', 'goToEditExam')->name('teacher.exam.edit');
    Route::get('/courses/{id}', 'goToCourse')->name('teacher.course');
});
