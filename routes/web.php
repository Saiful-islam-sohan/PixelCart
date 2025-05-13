<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.layouts.master');
});


Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'postLogin'])->name('post.login');



    Route::group(['middleware' => ['auth','role:admin|super-admin|manager']], function () {
        Route::get('/dashboard', [AdminLoginController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
        Route::resource('permissions', PermissionController::class);
        Route::resource('roles', RoleController::class);
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/index', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
        });

        Route::prefix('category')->name('category.')->group(function () {
            Route::get('/index', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
        });
    });
});
