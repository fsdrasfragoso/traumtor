<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FootballMatchController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users','cors'])->group(function () {

        Route::get('football-matches', [FootballMatchController::class, 'index'])->name('web.admin.football_matches.index');
        Route::get('football-matches/export', [FootballMatchController::class, 'export'])->name('web.admin.football_matches.export');
        Route::get('football-matches/create', [FootballMatchController::class, 'create'])->name('web.admin.football_matches.create');
        Route::post('football-matches', [FootballMatchController::class, 'store'])->name('web.admin.football_matches.store');
        Route::get('football-matches/{id}/edit', [FootballMatchController::class, 'edit'])->name('web.admin.football_matches.edit');
        Route::put('football-matches/{id}', [FootballMatchController::class, 'update'])->name('web.admin.football_matches.update');
        Route::get('football-matches/{id}', [FootballMatchController::class, 'show'])->name('web.admin.football_matches.show');
        Route::delete('football-matches/{id}', [FootballMatchController::class, 'delete'])->name('web.admin.football_matches.delete');
        Route::post('football-matches/{id}/restore', [FootballMatchController::class, 'restore'])->name('web.admin.football_matches.restore');
    });
});
