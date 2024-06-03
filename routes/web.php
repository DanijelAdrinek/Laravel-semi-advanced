<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

// USING MIDDLEWARE
// ->middleware('auth') at the end of route, or add it to a controller (ex. DashboardController)

// DASHBOARD
// we use ->name to help us when using {{ route('register) }} helper in view files
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// REGISTER
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

// LOGOUT
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/posts', function () {
    return view('posts.index');
})->name('posts');
