<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(StudentController::class)->prefix('student')->group(function () {
    Route::post('/exams/{id}', 'bookExam')->name('student.exams.book');
    Route::delete('/exams/{id}', 'deleteExamBooking')->name('student.exams.delete');
});

Route::controller(TeacherController::class)->prefix('teacher')->group(function () {
    Route::post('/exam', 'createExam')->name('teacher.exam.create');
    Route::post('/exam/{id}', 'editExam')->name('teacher.exam.edit');
});
