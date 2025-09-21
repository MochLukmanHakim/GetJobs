<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController; 
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FullscreenController;
use App\Http\Controllers\FindJobController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\CVController;

// 🏠 Halaman utama langsung ke LandingController
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Search Jobs (Landing)
Route::get('/search-jobs', [LandingController::class, 'searchJobs'])->name('search.jobs');

// Register
// Register
Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');


// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Find Job
Route::get('/findjob', [FindJobController::class, 'index'])->name('findjob');
// Search FindJob
Route::get('/findjob/search', [FindJobController::class, 'search'])->name('findjob.search');

// FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('faq');

// Tabel
Route::get('/riwayat', [RiwayatController::class, 'index'])->middleware(['auth:pelamar'])->name('riwayat');

// Profil
Route::get('/profil', [ProfilController::class, 'show'])->name('profil'); // tampilkan profil
Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update'); // update profil
Route::post('/profil/update-foto', [ProfilController::class, 'updateFoto'])->name('profil.updateFoto'); // upload foto profil


 Route::get('/header', function () {
    return view('header');
});

 Route::get('/coba', function () {
    return view('coba');
});




Route::post('/send-cv', [CVController::class, 'store'])->name('send.cv');



