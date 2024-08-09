<?php

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

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;



Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('web.admin.login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('logout', [LoginController::class, 'logout'])->name('web.admin.logout');

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('web.admin.password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('web.admin.password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('web.admin.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('web.admin.password.update');

    Route::prefix('user')->group(function () { 
        Route::middleware(['auth:users'])->group(function () {
            Route::get('users', [UserController::class, 'index'])->name('web.admin.users.index');
            Route::get('users/create', [UserController::class, 'create'])->name('web.admin.users.create');
            Route::post('users', [UserController::class, 'store'])->name('web.admin.users.store');
            Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('web.admin.users.edit');
            Route::any('users/validation/{id?}', [UserController::class, 'validation'])->name('web.admin.users.validation');
            Route::put('users/{id}', [UserController::class, 'update'])->name('web.admin.users.update');
            Route::delete('users/{id}', [UserController::class, 'delete'])->name('web.admin.users.delete');
            Route::put('users/{id}/restore', [UserController::class, 'restore'])->name('web.admin.users.restore');
            Route::get('/', [UserController::class, 'edit'])->name('web.admin.auth.user.edit');
            Route::put('/', [UserController::class, 'update'])->name('web.admin.auth.user.update');
        });
    });
});