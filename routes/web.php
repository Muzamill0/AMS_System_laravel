<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DynamicController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CourseStudentController;

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
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login_view')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'register_view')->name('register');
    Route::post('/register', 'register');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(CourseController::class)->group(function () {
    Route::get('courses', 'index')->name('courses');
    Route::get('add/course', 'create')->name('course.create');
    Route::post('add/course', 'store');
    Route::get('edit/{course}/course', 'edit')->name('course.edit');
    Route::post('edit/{course}/course', 'update');
});

Route::controller(StudentController::class)->group(function () {
    Route::get('students', 'index')->name('students');
    Route::get('student/add', 'create')->name('student.create');
    Route::post('student/add', 'store');
    Route::get('student/{student}/profile', 'show')->name('student.profile');
    Route::get('edit/{student}/student', 'edit')->name('student.edit');
    Route::post('edit/{student}/student', 'update');
});

Route::controller(CourseStudentController::class)->group(function () {
    Route::get('Course/{course}/students', 'index')->name('course.students');
});

Route::controller(AttendanceController::class)->group(function () {
    Route::get('course/{course}/attendances', 'index')->name('course.attendances');
    Route::get('course/{course}/attendance/create', 'create')->name('course.attendance.create');
    Route::post('course/{course}/attendance/create', 'store');
    Route::get('course/{attendance}/attendance/edit', 'edit')->name('course.attendance.edit');
    Route::post('course/{attendance}/attendance/edit', 'update');
});

Route::controller(DynamicController::class)->group(function () {
    Route::post('course/attendances', 'fetch_attendance')->name('fetch.attendances');
});


