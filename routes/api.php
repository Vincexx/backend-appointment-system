<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\DentistController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\User\AppointmentController as UserAppointmentController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('user')->name('user.')->group(function () {
        Route::apiResource('appointments', UserAppointmentController::class);
        Route::get('services', [ServiceController::class, 'index']);
        Route::get('dentists', [DentistController::class, 'index']);
        Route::get('locations', [LocationController::class, 'index']);
        Route::get('availability', [AvailabilityController::class, 'index']);
    });
    
    Route::prefix("admin")->name('admin.')->middleware('admin')->group(function () {
        Route::apiResource('appointments', AdminAppointmentController::class);
        Route::apiResource('services', ServiceController::class);
        Route::apiResource('dentists', DentistController::class);
        Route::apiResource('locations', LocationController::class);
        Route::apiResource('availability', AvailabilityController::class);
    });
});