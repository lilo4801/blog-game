<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\ReportController;
use \App\Http\Controllers\CommentController;
use \App\Http\Controllers\LikeController;
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
    Route::POST('/profile/unfollow', [FollowController::class, 'update'])->name('follow.update');
    Route::get('/profile/{id}', [UserController::class, 'show'])->name('user');

    Route::get('/report/{id}', [ReportController::class, 'create'])->name('user.report');
    Route::post('/report', [ReportController::class, 'store'])->name('user.report.store');
    Route::resource('posts.comments', CommentController::class)->except(['create', 'show', 'index']);
    Route::resource('posts', PostController::class);
    Route::post('/like', [LikeController::class, 'store'])->name('user.like');
    Route::delete('/unlike', [LikeController::class, 'destroy'])->name('user.unlike');

    Route::get('/list-post/{type}', [PostController::class, 'showList'])->name('posts.list')
        ->where('type', '[0-9]+');

});
Route::get('/home', [HomeController::class, 'index'])->name('home');

