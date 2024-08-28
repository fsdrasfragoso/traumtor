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
use App\Http\Controllers\Frontend\FootballMatchController;
/*
|--------------------------------------------------------------------------
| Usuário
|--------------------------------------------------------------------------
*/

Route::prefix('usuario')->middleware(['auth:api,footballers', 'footballer_block'])->group(function () {
    Route::get('football-matches', [FootballMatchController::class, 'index'])->name('web.frontend.football_matches.index');
    Route::get('football-matches/export', [FootballMatchController::class, 'export'])->name('web.frontend.football_matches.export');
    Route::get('football-matches/create', [FootballMatchController::class, 'create'])->name('web.frontend.football_matches.create');
    Route::post('football-matches', [FootballMatchController::class, 'store'])->name('web.frontend.football_matches.store');
    Route::get('football-matches/{id}/edit', [FootballMatchController::class, 'edit'])->name('web.frontend.football_matches.edit');
    Route::put('football-matches/{id}', [FootballMatchController::class, 'update'])->name('web.frontend.football_matches.update');
    Route::get('football-matches/{id}', [FootballMatchController::class, 'show'])->name('web.frontend.football_matches.show');
    Route::delete('football-matches/{id}', [FootballMatchController::class, 'delete'])->name('web.frontend.football_matches.delete');
    Route::post('football-matches/{id}/restore', [FootballMatchController::class, 'restore'])->name('web.frontend.football_matches.restore');
});