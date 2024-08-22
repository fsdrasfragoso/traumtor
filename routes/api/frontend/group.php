<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\GroupController;

Route::prefix('group')->middleware(['apiJwt','cors'])->group(function () {
    Route::get('/all', [GroupController::class, 'all'])->name('api.frontend.groups.all');
    Route::get('/columns', [GroupController::class, 'getTranslateAdminColumns'])->name('api.frontend.groups.columns');
    Route::get('/lines', [GroupController::class, 'getAdminLines'])->name('api.frontend.groups.lines');
    Route::get('/actions', [GroupController::class, 'getAdminActions'])->name('api.frontend.groups.actions');
    Route::get('/options', [GroupController::class, 'getSelectOptions'])->name('api.frontend.groups.options');
    Route::get('/{id}', [GroupController::class, 'findOne'])->name('api.frontend.groups.findOne');
    Route::delete('/{id}', [GroupController::class, 'deleteById'])->name('api.frontend.groups.deleteById');
    Route::post('/create', [GroupController::class, 'store'])->name('api.frontend.groups.store');
    Route::get('/{id}', [GroupController::class, 'show'])->name('api.frontend.groups.show');
    Route::put('/{id}', [GroupController::class, 'update'])->name('api.frontend.groups.update');
    Route::delete('/{id}', [GroupController::class, 'delete'])->name('api.frontend.groups.delete');
});
