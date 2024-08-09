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
use App\Http\Controllers\Admin\ModalityController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users','cors'])->group(function () {       
        Route::get('modalities', [ModalityController::class, 'index'])->name('web.admin.modalities.index');
        Route::get('modalities/export', [ModalityController::class, 'export'])->name('web.admin.modalities.export');
        Route::get('modalities/create', [ModalityController::class, 'create'])->name('web.admin.modalities.create');
        Route::post('modalities', [ModalityController::class, 'store'])->name('web.admin.modalities.store');
        Route::get('modalities/{id}/edit', [ModalityController::class, 'edit'])->name('web.admin.modalities.edit');
        Route::put('modalities/{id}', [ModalityController::class, 'update'])->name('web.admin.modalities.update');
        Route::get('modalities/{id}', [ModalityController::class, 'show'])->name('web.admin.modalities.show');
        Route::delete('modalities/{id}', [ModalityController::class, 'delete'])->name('web.admin.modalities.delete');        
        Route::post('modalities/{id}/restore', [ModalityController::class, 'restore'])->name('web.admin.modalities.restore');
    });
});
