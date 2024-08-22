<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GroupController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users','cors'])->group(function () {

        Route::get('groups', [GroupController::class, 'index'])->name('web.admin.groups.index');
        Route::get('groups/export', [GroupController::class, 'export'])->name('web.admin.groups.export');
        Route::get('groups/create', [GroupController::class, 'create'])->name('web.admin.groups.create');
        Route::post('groups', [GroupController::class, 'store'])->name('web.admin.groups.store');
        Route::get('groups/{id}/edit', [GroupController::class, 'edit'])->name('web.admin.groups.edit');
        Route::put('groups/{id}', [GroupController::class, 'update'])->name('web.admin.groups.update');
        Route::get('groups/{id}', [GroupController::class, 'show'])->name('web.admin.groups.show');
        Route::delete('groups/{id}', [GroupController::class, 'delete'])->name('web.admin.groups.delete');
        Route::post('groups/{id}/restore', [GroupController::class, 'restore'])->name('web.admin.groups.restore');
    });
});
