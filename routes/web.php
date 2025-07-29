<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/', function () {
    return view('login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
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


