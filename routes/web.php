<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/profile/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user');
Route::get('/profile/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
Route::POST('/profile/updateImg', [App\Http\Controllers\UserController::class, 'updateImg'])->name('user.updateImg');
Route::POST('/profile/updateInfo', [App\Http\Controllers\UserController::class, 'updateInfo'])->name('user.updateInfo');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
