<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

// Admin dashboard routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/user-management', 'admin.user_management')->name('user-management');
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::view('/job-management', 'admin.job_management')->name('job-management');
    Route::view('/settings', 'admin.settings')->name('settings');
});