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
use App\Http\Controllers\Admin\TacticalFormationController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users', 'cors'])->group(function () {       

        // Routes for TacticalFormationController
        Route::get('tactical-formations', [TacticalFormationController::class, 'index'])->name('web.admin.tactical_formations.index');
        Route::get('tactical-formations/export', [TacticalFormationController::class, 'export'])->name('web.admin.tactical_formations.export');
        Route::get('tactical-formations/create', [TacticalFormationController::class, 'create'])->name('web.admin.tactical_formations.create');
        Route::post('tactical-formations', [TacticalFormationController::class, 'store'])->name('web.admin.tactical_formations.store');
        Route::get('tactical-formations/{id}/edit', [TacticalFormationController::class, 'edit'])->name('web.admin.tactical_formations.edit');
        Route::put('tactical-formations/{id}', [TacticalFormationController::class, 'update'])->name('web.admin.tactical_formations.update');
        Route::get('tactical-formations/{id}', [TacticalFormationController::class, 'show'])->name('web.admin.tactical_formations.show');
        Route::delete('tactical-formations/{id}', [TacticalFormationController::class, 'delete'])->name('web.admin.tactical_formations.delete');
        Route::post('tactical-formations/{id}/restore', [TacticalFormationController::class, 'restore'])->name('web.admin.tactical_formations.restore');
    });
});
