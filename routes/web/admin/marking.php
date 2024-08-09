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
use App\Http\Controllers\Admin\MarkingController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users','cors'])->group(function () {

        Route::get('markings', [MarkingController::class, 'index'])->name('web.admin.markings.index');
        Route::get('markings/create', [MarkingController::class, 'create'])->name('web.admin.markings.create');
        Route::post('markings', [MarkingController::class, 'store'])->name('web.admin.markings.store');
        Route::get('markings/{id}/edit', [MarkingController::class, 'edit'])->name('web.admin.markings.edit');
        Route::put('markings/{id}', [MarkingController::class, 'update'])->name('web.admin.markings.update');
        Route::delete('markings/{id}', [MarkingController::class, 'destroy'])->name('web.admin.markings.delete');
        Route::post('markings/{id}/restore', [MarkingController::class, 'restore'])->name('web.admin.markings.restore');
        
    });
});
