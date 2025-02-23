<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
    Route::get('/', function () {
    return view('welcome');
});
Route::get('/index',function () {
    return view('Layouts.dashboard');
});
Route::resource('/users',UserController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
