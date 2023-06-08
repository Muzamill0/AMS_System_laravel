<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DynamicController;
use App\Http\Controllers\StudentController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\StudentAttendanceController;

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

Route::controller(AuthController::class)->middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/login', 'login_view')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'register_view')->name('register');
    Route::post('/register', 'register');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(Authenticate::class)->group(function(){
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
        Route::get('single/{student}/student/attendances', 'single_student_view')->name('single.student.attendance');
        Route::Post('single/student/attendance', 'fetch_single_student_attendance')->name('single.student.attendance.fetch');
    });

    Route::controller(LeaveController::class)->group(function () {
        Route::get('leaves', 'index')->name('leaves');
        Route::post('leaves/{leave}/action', 'store')->name('leave.action');
    });

});

Route::prefix('student/')->name('student.')->middleware(Authenticate::class)->group(function(){

    Route::get('/dashboard', [DashboardController::class, 'student_home'])->name('dashboard');

    Route::controller(StudentAttendanceController::class)->group(function () {
        Route::get('attendances', 'index')->name('attendances');
        Route::get('attendances/{student}/create', 'create')->name('attendance.create');
        Route::post('attendances/{student}/create', 'store');
    });

    Route::controller(StudentProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile');
        Route::get('profile/{student}/edit', 'edit')->name('profile.edit');
        Route::post('profile/{student}/edit', 'update');
    });

});
