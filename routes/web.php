<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

// Admin dashboard routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/user-management', 'user_management')->name('user-management');
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/job-management', 'job_management')->name('job-management');
    Route::view('/settings', 'settings')->name('settings');
});