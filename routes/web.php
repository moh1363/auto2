<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostTitleController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\MorakhasiController;
use App\Http\Controllers\RoleController;


Route::get('/',function () {
    return view('Layouts.dashboard');})->middleware('auth');;

Route::resource('/users',UserController::class)->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/post-titles', PostTitleController::class)->middleware('auth');;
Route::get('/fetch', [PostTitleController::class, 'fetch'])->name('posttitle.fetch');
Route::resource('/morakhasi',\App\Http\Controllers\MorakhasiController::class);
Route::resource('/approval',\App\Http\Controllers\MorakhasiApprovalController::class);
Route::resource('roles', RoleController::class);
Route::post('/permisiions/create',[RoleController::class,'createPermission'])->name('permission.store');
Route::resource('/skills',\App\Http\Controllers\SkillController::class);
Route::get('/skillsfetch',[\App\Http\Controllers\SkillController::class,'fetch']);
Route::get('/skills', [\App\Http\Controllers\TrainingController::class, 'index']);
Route::post('/skills', [\App\Http\Controllers\TrainingController::class, 'store']);
Route::post('/users/{userId}/skills', [\App\Http\Controllers\TrainingController::class, 'assignSkillsToUser']); // Assign skills to user
Route::get('/users/{userId}/skills', [\App\Http\Controllers\TrainingController::class, 'showUserSkills']); // Show skills of user
Route::get('/home2',[\App\Http\Controllers\TrainingController::class,'home']);
