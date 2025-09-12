<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PekerjaanController;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome.alt');

// Rute untuk pekerjaan
Route::get('/pekerjaan', [PekerjaanController::class, 'index'])->name('pekerjaan.index');
Route::get('/pekerjaan/create', [PekerjaanController::class, 'create'])->name('pekerjaan.create');
Route::post('/pekerjaan', [PekerjaanController::class, 'store'])->name('pekerjaan.store');
Route::put('/pekerjaan/{id}', [PekerjaanController::class, 'update'])->name('pekerjaan.update');
Route::delete('/pekerjaan/{id}', [PekerjaanController::class, 'destroy'])->name('pekerjaan.destroy');

// Rute untuk halaman perusahaan
Route::get('/perusahaan', [PerusahaanController::class, 'profile'])->name('perusahaan.profile');
Route::get('/perusahaan/create', [PerusahaanController::class, 'profile'])->name('perusahaan.create');
Route::post('/perusahaan', [PerusahaanController::class, 'store'])->name('perusahaan.store');
Route::get('/perusahaan/{id}', [PerusahaanController::class, 'show'])->name('perusahaan.show');
Route::get('/perusahaan/{id}/edit', [PerusahaanController::class, 'edit'])->name('perusahaan.edit');
Route::put('/perusahaan/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
Route::delete('/perusahaan/{id}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');

// Rute untuk dashboard perusahaan
Route::get('/perusahaan/dashboard', [PerusahaanController::class, 'profile'])->name('perusahaan.dashboard');

// Rute untuk halaman lainnya
Route::get('/pelamar', function () {
    // Get only 10 latest jobs and their job titles for search dropdown
    $pekerjaan = \App\Models\Pekerjaan::orderBy('created_at', 'desc')->limit(10)->get();
    
    // Get unique job titles from the displayed jobs
    $categories = $pekerjaan->pluck('judul_pekerjaan')
        ->filter(function($title) {
            return !empty($title);
        })
        ->unique()
        ->values()
        ->toArray();
    
    return view('pelamar', compact('categories'));
})->name('pelamar');

Route::get('/statistik', function () {
    return view('statistik');
})->name('statistik');

Route::get('/account', function () {
    return view('account');
})->name('account');

// Rute untuk autentikasi
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/signup', [UserController::class, 'signup'])->name('register');
Route::post('/login', [UserController::class, 'logincheck'])->name('logincheck');
Route::post('/signup', [UserController::class, 'registercheck'])->name('registercheck');

Route::get('/dashboard', [UserController::class, 'godashboard'])->name('dashboard');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Rute untuk halaman standalone find job
Route::get('/findjob-standalone', function () {
    return view('findjob-standalone');
})->name('findjob.standalone');


