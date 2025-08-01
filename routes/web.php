<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/home', function () {
    return view('home');
});
// Route::get('/', function () {
//     return view('login');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });
Route::get('/lowongan', function () {
    return view('lowongan');
});
Route::get('/pelamar', function () {
    return view('pelamar');
});
Route::get('/statistik', function () {
    return view('statistik');
});
Route::get('/account', function () {
    return view('account');
});

Route::get('/', [UserController::class, 'login']) ->name('login');
Route::get('/signup', [UserController::class, 'signup']) ->name('register');
Route::post('login', [UserController::class, 'logincheck']) ->name('logincheck');
Route::post('signup', [UserController::class, 'registercheck']) ->name('registercheck');

Route::get('/dashboard', [UserController::class, 'godashboard']) ->name('dashboard');
Route::post('/logout', [UserController::class, 'logout']) ->name('logout');
