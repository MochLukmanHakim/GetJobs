<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController; 
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FullscreenController;
use App\Http\Controllers\FindJobController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TabelController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\CVController;

// 🏠 Halaman utama langsung ke LandingController
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Register
Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Find Job
Route::get('/findjob', [FindJobController::class, 'index'])->name('findjob');

// FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

// Tabel
Route::get('/tabel', [TabelController::class, 'index'])->name('tabel');

 Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
 Route::post('/profil', [ProfilController::class, 'update'])->name('profil.update');

 Route::get('/header', function () {
    return view('header');
});

 Route::get('/coba', function () {
    return view('coba');
});

Route::get('/profil', function () {
    return view('profil'); 
})->name('profil');


Route::post('/send-cv', [CVController::class, 'store'])->name('send.cv');
