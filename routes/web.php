<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\LoginHistoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'LoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'RegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('hello');
    });

    Route::group(['middleware' => 'auth.admin'], function () {
        
        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        Route::get('/admin/login-histories', [LoginHistoryController::class, 'index'])->name('admin.login_histories.index');
        Route::delete('admin/posts/bulk-delete', [PostController::class, 'bulkDelete'])->name('admin.posts.bulk-delete');

        Route::resource('admin/posts', PostController::class)->names([
            'index' => 'admin.posts.index',
            'create' => 'admin.posts.create',
            'store' => 'admin.posts.store',
            'show' => 'admin.posts.show',
            'edit' => 'admin.posts.edit',
            'update' => 'admin.posts.update',
            'destroy' => 'admin.posts.destroy',
        ]);

        Route::resource('admin/tags', TagController::class)->names([
            'index' => 'admin.tags.index',
            'create' => 'admin.tags.create',
            'store' => 'admin.tags.store',
            'show' => 'admin.tags.show',
            'edit' => 'admin.tags.edit',
            'update' => 'admin.tags.update',
            'destroy' => 'admin.tags.destroy',
        ]);

    });
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
