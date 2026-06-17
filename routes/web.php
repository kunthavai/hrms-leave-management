<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\DashboardController;
Route::get('/',[AuthController::class,'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::middleware(['auth', 'role.menu'])->group(function () {
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
Route::get('/getEmployee/{employee}', [EmployeeController::class, 'getEmployee'])->name('employees.getDetails');
Route::match(['get', 'post'], '/employees/createOrUpdate',[EmployeeController::class,'createOrUpdate'])->name('employees.create');
 Route::delete('/employees/{id}', [EmployeeController::class, 'delete'])
        ->name('employees.delete'); 
//Route::get('/applyLeave', [LeaveController::class, 'applyLeave'])->name('applyLeave');
Route::match(['get', 'post'], '/applyLeave',[LeaveController::class,'applyLeave'])->name('applyLeave');

Route::get('/getLeave/{leave}', [LeaveController::class, 'getLeave'])->name('leaves.getDetails');
Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves');
Route::delete('/leaves/{id}', [LeaveController::class, 'delete'])
        ->name('leaves.delete'); 
Route::get('/pendingLeaves', [LeaveController::class, 'pendingLeaves'])->name('pendingLeaves');
Route::post('/leaveBulkApprove', [LeaveController::class, 'leaveBulkApprove'])->name('leaveBulkApprove');
Route::post('/leaveBulkReject', [LeaveController::class, 'leaveBulkReject'])->name('leaveBulkReject');
Route::get('/leaveStatistics',[DashboardController::class, 'index'])->name('leaveStatistics');
});
        


