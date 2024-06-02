<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

// we use ->name to help us when using {{ route('register) }} helper in view files
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/posts', function () {
    return view('posts.index');
});
