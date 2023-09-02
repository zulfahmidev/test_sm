<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\ApproverController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleReturnController;
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

// Auth Routes
Route::prefix('auth')->group(function() {
    Route::get('login', [AuthController::class, 'loginForm'])->name('auth.login.form');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Dashboard Routes
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('role:admin|approver');

// Vehicle Routes
Route::resource('vehicle', VehicleController::class)->middleware('role:admin');

// Driver Routes
Route::resource('driver', DriverController::class)->middleware('role:admin');

// Booking Routes
Route::resource('booking', BookingController::class)->middleware('role:admin');

// Approver Routes
Route::resource('approver', ApproverController::class)->middleware('role:admin');

// Approval Routes
Route::resource('approval', ApprovalController::class)->only('index', 'show', 'update')->middleware('role:approver');

// Service Routes
Route::prefix('service')->group(function() {

    Route::get('/', [ServiceController::class, 'index'])->name('service');

});

// Maintenance Routes
Route::prefix('maintenance')->group(function() {

    Route::get('/', [MaintenanceController::class, 'index'])->name('maintenance');

});

// Vehicle Return Routes
Route::prefix('vehicle-return')->group(function() {

    Route::get('/', [VehicleReturnController::class, 'index'])->name('vehicle-return');

});