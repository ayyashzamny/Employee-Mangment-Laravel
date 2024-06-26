<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;

Route::get('/', function () {
    return view('welcome');
});
// Employee Routes
Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/employees/list', [EmployeeController::class, 'list']);
Route::post('/employees/store', [EmployeeController::class, 'store']);

// Department Routes
Route::get('/departments/list', [DepartmentController::class, 'list']);
Route::post('/departments/store', [DepartmentController::class, 'store']);

// Designation Routes
Route::get('/designations/list', [DesignationController::class, 'list']);
Route::post('/designations/store', [DesignationController::class, 'store']);
