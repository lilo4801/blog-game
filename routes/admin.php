<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\LoginController;
use \App\Http\Controllers\GameController;
use \App\Http\Controllers\Admin\HomeController;
use \App\Http\Controllers\Admin\ReportController;

Route::prefix('admin')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [RegisterController::class, 'register'])->name('admin.register');

    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
    });

    Route::middleware(['admin'])->group(function () {

        Route::resource('games', GameController::class);
        Route::post('/logout', [LoginController::class, 'destroy'])->name('admin.logout');
        Route::get('/home', [HomeController::class, 'index'])->name('admin.home');

        Route::post('/report', [ReportController::class, 'update'])->name('admin.report.update');

    });
});
