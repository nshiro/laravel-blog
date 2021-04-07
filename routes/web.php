<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Mypage\BlogController;
use App\Http\Controllers\Mypage\UserLoginController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index']);
Route::get('blogs/{blog}', [HomeController::class, 'show'])->name('blog.show');

Route::get('signup', [SignupController::class, 'index']);
Route::post('signup', [SignupController::class, 'store']);

Route::middleware('guest')->group(function () {
    Route::get('mypage/login', [UserLoginController::class, 'index'])->name('login');
    Route::post('mypage/login', [UserLoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('mypage/logout', [BlogController::class, 'logout']);

    Route::get('mypage', [BlogController::class, 'index']);
});
