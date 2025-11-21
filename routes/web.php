<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('employees',EmployeeController::class);
Route::resource('departments',DepartmentController::class);
Route::resource('salaries', SalariesController::class);
Route::resource('positions', PositionController::class);
Route::resource('attendance',AttendanceController::class);
Route::resource('users',UserController::class);