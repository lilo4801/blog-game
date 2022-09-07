<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['user'])->group(function () {
    Route::get('/profile/{id}', [UserController::class, 'show'])->name('user');
    Route::get('/profile/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::POST('/profile/updateImg/{id}', [UserController::class, 'updateImg'])->name('user.updateImg');
    Route::POST('/profile/updateInfo/{id}', [UserController::class, 'updateInfo'])->name('user.updateInfo');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');
