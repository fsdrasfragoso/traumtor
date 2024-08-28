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
use App\Http\Controllers\Frontend\TeamController;
/*
|--------------------------------------------------------------------------
| Usuário
|--------------------------------------------------------------------------
*/

Route::prefix('usuario')->middleware(['auth:api,footballers', 'footballer_block'])->group(function () {
    Route::get('teams', [TeamController::class, 'index'])->name('web.frontend.teams.index');
    Route::get('teams/export', [TeamController::class, 'export'])->name('web.frontend.teams.export');
    Route::get('teams/create', [TeamController::class, 'create'])->name('web.frontend.teams.create');
    Route::post('teams', [TeamController::class, 'store'])->name('web.frontend.teams.store');
    Route::get('teams/{id}/edit', [TeamController::class, 'edit'])->name('web.frontend.teams.edit');
    Route::put('teams/{id}', [TeamController::class, 'update'])->name('web.frontend.teams.update');
    Route::get('teams/{id}', [TeamController::class, 'show'])->name('web.frontend.teams.show');
    Route::delete('teams/{id}', [TeamController::class, 'delete'])->name('web.frontend.teams.delete');
    Route::post('teams/{id}/restore', [TeamController::class, 'restore'])->name('web.frontend.teams.restore');
});