<?php

use App\Http\Controllers\HomeController;
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

//Route::get('/login', fn() => view('login'));

Route::get('/', fn() => view('welcome'));

Route::controller(StudentController::class)->prefix('student/{id}')->group(function () {
    Route::get('/', 'index')->name('student.dashboard');
    Route::get('/bookings', 'booking')->name('student.bookings');
    Route::get('/career', 'career')->name('student.career');
});

Route::controller(TeacherController::class)->prefix('teacher/{id}')->group(function () {
    Route::get('/', 'index')->name('teacher.dashboard');
    Route::get('/exam', 'exam')->name('teacher.exam');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
