<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PresensiController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    // Admin Routes
    Route::middleware('can:isAdmin')->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('salaries', SalariesController::class);
        Route::post('/salaries/generate', [SalariesController::class, 'generate'])->name('salaries.generate');
        Route::resource('positions', PositionController::class);
        Route::resource('attendance', AttendanceController::class);
        Route::resource('users', UserController::class);
    });

    // Pegawai Routes
    Route::middleware('can:isPegawai')->group(function () {
        Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
        Route::post('/presensi', [PresensiController::class, 'store'])->name('presensi.store');
    });
});