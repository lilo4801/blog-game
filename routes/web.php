<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FavoriteGameController;

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
    Route::get('/profile/addGame', [FavoriteGameController::class, 'create'])->name('user.addGame');
    Route::post('/profile/addGame', [FavoriteGameController::class, 'store'])->name('user.storeGame');
    Route::post('/profile/removeGame/{id}', [FavoriteGameController::class, 'destroy'])->name('user.removeGame');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::POST('/profile/updateImg', [UserController::class, 'updateImg'])->name('user.updateImg');
    Route::POST('/profile/updateInfo', [UserController::class, 'updateInfo'])->name('user.updateInfo');
    Route::POST('/profile/follow', [FollowController::class, 'store'])->name('follow.store');
    Route::POST('/profile/unfollow/{id}', [FollowController::class, 'update'])->name('follow.update');
    Route::get('/profile/{id}', [UserController::class, 'show'])->name('user');


});


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('posts', PostController::class);
