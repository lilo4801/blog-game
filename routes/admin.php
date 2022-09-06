<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;


Route::prefix('admin')->group(function () {

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('admin.register');
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [LoginController::class, 'login'])->name('admin.login');


    });

    Route::middleware(['admin'])->group(function () {
        Route::post('/logout', [LoginController::class, 'destroy'])->name('admin.logout');
        Route::view('/home', 'admin.home')->name('admin.home');


    });



});
