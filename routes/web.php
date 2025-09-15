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
    // Get all jobs with their titles and categories for search dropdown
    $jobs = \App\Models\Pekerjaan::select('judul_pekerjaan', 'kategori_pekerjaan')
        ->whereNotNull('judul_pekerjaan')
        ->where('judul_pekerjaan', '!=', '')
        ->get();
    
    // Apply the same display logic as in pekerjaan.blade.php
    $categories = $jobs->map(function($job) {
        $rawTitle = trim(preg_replace('/\s+/', ' ', $job->judul_pekerjaan ?? ''));
        $words = $rawTitle !== '' ? preg_split('/\s+/', $rawTitle, -1, PREG_SPLIT_NO_EMPTY) : [];
        $displayTitle = $rawTitle;
        
        // If only 2 words, append category
        if (count($words) === 2) {
            $catText = ucwords(str_replace(['-', '_'], ' ', $job->kategori_pekerjaan ?? ''));
            if ($catText !== '') {
                $displayTitle = $rawTitle.' '.$catText;
            }
        }
        
        return $displayTitle;
    })
    ->filter(function($title) {
        return !empty($title);
    })
    ->unique()
    ->sort()
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


