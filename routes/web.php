<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostTitleController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\MorakhasiController;

Route::get('/',function () {
    return view('Layouts.dashboard');})->middleware('auth');;

Route::resource('/users',UserController::class)->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/post-titles', PostTitleController::class)->middleware('auth');;
Route::get('/fetch', [PostTitleController::class, 'fetch'])->name('posttitle.fetch');
Route::resource('/morakhasi',\App\Http\Controllers\MorakhasiController::class);
Route::resource('/approval',\App\Http\Controllers\MorakhasiApprovalController::class);
