<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::delete('employees/{employee}/force', [EmployeeController::class, 'forceDelete'])->name('employees.forceDelete');

Route::resource('employees', EmployeeController::class);

Route::resource('departments', DepartmentController::class);

Route::resource('positions', PositionController::class);

Route::resource('salaries', SalaryController::class);

Route::resource('attendances', AttendanceController::class);
