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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\Front\FrontController::class, 'index']);
Route::get('/category/{category_slug}', [App\Http\Controllers\Front\FrontController::class, 'view_category']);
Route::get('/{category_slug}/{post_slug}', [App\Http\Controllers\Front\FrontController::class, 'view_post']);

// Comment System
Route::post('/comments', [App\Http\Controllers\Front\CommentController::class, 'store']);
Route::delete('/delete-comment', [App\Http\Controllers\Front\CommentController::class, 'destroy']);

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function() {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('/add-category', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::post('/add-category', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
    Route::get('/edit-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::put('/edit-category/{category_id}', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::delete('/delete-category', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']);

    Route::get('/posts', [App\Http\Controllers\Admin\PostController::class, 'index']);
    Route::get('/add-post', [App\Http\Controllers\Admin\PostController::class, 'create']);
    Route::post('/add-post', [App\Http\Controllers\Admin\PostController::class, 'store']);
    Route::get('/edit-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'edit']);
    Route::put('/edit-post/{post_id}', [App\Http\Controllers\Admin\PostController::class, 'update']);
    Route::delete('/delete-post', [App\Http\Controllers\Admin\PostController::class, 'destroy']);

    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::post('/edit-user', [App\Http\Controllers\Admin\UserController::class, 'store']);
    Route::delete('/delete-user', [App\Http\Controllers\Admin\UserController::class, 'destroy']);

    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index']);
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'store']);

});