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
use App\Http\Controllers\Admin\RoleController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users','cors'])->group(function () {
        Route::get('roles',[RoleController::class, 'index'])->name('web.admin.roles.index');
        Route::get('roles/create', [RoleController::class, 'create'])->name('web.admin.roles.create');
        Route::post('roles', [RoleController::class, 'store'])->name('web.admin.roles.store');
        Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('web.admin.roles.edit');
        Route::any('roles/validation/{id?}', [RoleController::class, 'validation'])->name('web.admin.roles.validation');
        Route::put('roles/{id}',  [RoleController::class, 'update'])->name('web.admin.roles.update');
        Route::delete('roles/{id}', [RoleController::class, 'delete'])->name('web.admin.roles.delete');
        Route::put('roles/{id}/restore', [RoleController::class, 'restore'])->name('web.admin.roles.restore');
    });
});
