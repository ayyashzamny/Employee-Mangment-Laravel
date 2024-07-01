<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\AnnualLeaveController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\AdminLeaveController;


// Employee Routes
Route::get('/', [EmployeeController::class, 'index']);
Route::get('/employees/list', [EmployeeController::class, 'list']);
Route::post('/employees/store', [EmployeeController::class, 'store']);

// Department Routes
Route::get('/departments/list', [DepartmentController::class, 'list']);
Route::post('/departments/store', [DepartmentController::class, 'store']);

// Designation Routes
Route::get('/designations/list', [DesignationController::class, 'list']);
Route::post('/designations/store', [DesignationController::class, 'store']);

// Annual Leave Routes
Route::get('/leaves/list', [AnnualLeaveController::class, 'index']);
Route::get('/leaves/create', [AnnualLeaveController::class, 'create']);
Route::post('/leaves/store', [AnnualLeaveController::class, 'store']);
Route::get('/leaves/show/{annualLeave}', [AnnualLeaveController::class, 'show']);

// Leave request routes
Route::put('/leave_requests/{id}', [LeaveRequestController::class, 'updateStatus'])->name('leave_requests.updateStatus');
Route::get('/leave_requests/create', [LeaveRequestController::class, 'create'])->name('leave_requests.create');
Route::post('/leave_requests', [LeaveRequestController::class, 'store'])->name('leave_requests.store');
Route::get('/leave_requests', [LeaveRequestController::class, 'index'])->name('leave_requests.index');
Route::get('/leave_requests/{id}', [LeaveRequestController::class, 'show'])->name('leave_requests.show');

Route::get('/admin-leaves', [AdminLeaveController::class, 'index'])->name('admin-leaves.index');
Route::get('/admin-leaves/{id}', [AdminLeaveController::class, 'show'])->name('admin-leaves.show');
Route::put('/admin-leaves/{id}', [AdminLeaveController::class, 'update'])->name('admin-leaves.update');