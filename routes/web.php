<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\PelamarController;

// Rute untuk halaman utama;

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome.alt');

// Rute untuk pekerjaan (protected by company access middleware)
Route::middleware(['company.access'])->group(function () {
    Route::get('/pekerjaan', [PekerjaanController::class, 'index'])->name('pekerjaan.index');
    Route::get('/pekerjaan/{id}', [PekerjaanController::class, 'show'])->name('pekerjaan.show');
    Route::post('/pekerjaan', [PekerjaanController::class, 'store'])->name('pekerjaan.store');
    Route::put('/pekerjaan/{id}', [PekerjaanController::class, 'update'])->name('pekerjaan.update');
    Route::delete('/pekerjaan/{id}', [PekerjaanController::class, 'destroy'])->name('pekerjaan.destroy');
    
    // API endpoint untuk histori pekerjaan
    Route::get('/api/job-history', [PekerjaanController::class, 'getJobHistory'])->name('api.job-history');
});

// Rute untuk halaman perusahaan
Route::get('/perusahaan', [PerusahaanController::class, 'profile'])->name('perusahaan.profile');
Route::get('/perusahaan/create', [PerusahaanController::class, 'profile'])->name('perusahaan.create');
Route::post('/perusahaan', [PerusahaanController::class, 'store'])->name('perusahaan.store');
Route::put('/perusahaan/profile/update', [PerusahaanController::class, 'updateProfile'])->name('perusahaan.profile.update');
Route::get('/perusahaan/{id}', [PerusahaanController::class, 'show'])->name('perusahaan.show');
Route::get('/perusahaan/{id}/edit', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');
Route::put('/perusahaan/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
Route::delete('/perusahaan/{id}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');

// Rute untuk dashboard perusahaan
Route::get('/perusahaan/dashboard', [PerusahaanController::class, 'profile'])->name('perusahaan.dashboard');

// Rute untuk pelamar (protected by company access middleware)
Route::middleware(['company.access'])->group(function () {
    Route::get('/pelamar', [PelamarController::class, 'index'])->name('pelamar.index');
    Route::post('/pelamar', [PelamarController::class, 'store'])->name('pelamar.store');
    Route::put('/pelamar/{id}/status', [PelamarController::class, 'updateStatus'])->name('pelamar.updateStatus');
    Route::put('/pelamar/{pelamar}/pengumuman', [PelamarController::class, 'updatePengumuman'])->name('pelamar.updatePengumuman');
    Route::post('/pelamar/{pelamar}/announcement', [PelamarController::class, 'sendAnnouncement'])->name('pelamar.sendAnnouncement');
    Route::delete('/pelamar/{pelamar}', [PelamarController::class, 'destroy'])->name('pelamar.destroy');
    Route::get('/pelamar/{pelamar}/cv', [PelamarController::class, 'viewCV'])->name('pelamar.viewCV');
    Route::post('/pelamar/bulk-status', [PelamarController::class, 'bulkUpdateStatus'])->name('pelamar.bulkUpdateStatus');
    Route::post('/pelamar/bulk-announcement', [PelamarController::class, 'bulkAnnouncement'])->name('pelamar.bulkAnnouncement');
    Route::get('/pelamar/stats', [PelamarController::class, 'getStats'])->name('pelamar.stats');
});

Route::get('/statistik', function () {
    return view('statistik');
})->name('statistik');

Route::get('/account', function () {
    return view('account');
})->name('account');

// Rute untuk autentikasi
Route::get('/', [UserController::class, 'login'])->name('login');
Route::get('/signup', [UserController::class, 'signup'])->name('register');
Route::post('/login', [UserController::class, 'logincheck'])->name('logincheck');
Route::post('/signup', [UserController::class, 'registercheck'])->name('register.process');

Route::get('/dashboard', [UserController::class, 'godashboard'])->name('dashboard');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


