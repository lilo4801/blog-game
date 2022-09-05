<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;


Route::prefix('admin')->group(function () {

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('admin.register');
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [LoginController::class, 'adminLogin'])->name('admin.login');
        Route::post('/login', [LoginController::class, 'adminLoginPost'])->name('admin.login');


    });

    Route::middleware(['admin'])->group(function () {
        Route::post('/logout', [LoginController::class, 'destroy'])->name('admin.logout');
        Route::view('/home', 'home')->name('admin.home');


    });



});
