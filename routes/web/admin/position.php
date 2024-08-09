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
use App\Http\Controllers\Admin\PositionController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users','cors'])->group(function () {

        Route::get('positions', [PositionController::class, 'index'])->name('web.admin.positions.index');
        Route::get('positions/export', [PositionController::class, 'export'])->name('web.admin.positions.export');
        Route::get('positions/create', [PositionController::class, 'create'])->name('web.admin.positions.create');
        Route::post('positions', [PositionController::class, 'store'])->name('web.admin.positions.store');
        Route::get('positions/{id}/edit', [PositionController::class, 'edit'])->name('web.admin.positions.edit');
        Route::put('positions/{id}', [PositionController::class, 'update'])->name('web.admin.positions.update');
        Route::get('positions/{id}', [PositionController::class, 'show'])->name('web.admin.positions.show');
        Route::delete('positions/{id}', [PositionController::class, 'delete'])->name('web.admin.positions.delete');
        Route::post('positions/{id}/restore', [PositionController::class, 'restore'])->name('web.admin.positions.restore');
    });
});
