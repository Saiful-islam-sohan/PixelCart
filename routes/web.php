<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.layouts.master');
});






Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',[AdminLoginController::class,'dashboard'])->name('dashboard');
    Route::get('/login',[AdminLoginController::class,'login'])->name('login');
    Route::post('/login',[AdminLoginController::class,'postLogin'])->name('post.login');
    Route::get('/logout',[AdminLoginController::class,'logout'])->name('logout');



    Route::resource('permissions', PermissionController::class);
});