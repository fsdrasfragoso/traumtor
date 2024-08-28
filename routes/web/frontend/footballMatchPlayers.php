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
use App\Http\Controllers\Frontend\FootballMatchPlayersController;

/*
|--------------------------------------------------------------------------
| Usuário
|--------------------------------------------------------------------------
*/

Route::prefix('usuario')->middleware(['auth:api,footballers', 'footballer_block'])->group(function () {
    Route::get('football-match-players', [FootballMatchPlayersController::class, 'index'])->name('web.frontend.football_match_players.index');
    Route::get('football-match-players/export', [FootballMatchPlayersController::class, 'export'])->name('web.frontend.football_match_players.export');
    Route::get('football-match-players/create', [FootballMatchPlayersController::class, 'create'])->name('web.frontend.football_match_players.create');
    Route::post('football-match-players', [FootballMatchPlayersController::class, 'store'])->name('web.frontend.football_match_players.store');
    Route::get('football-match-players/{id}/edit', [FootballMatchPlayersController::class, 'edit'])->name('web.frontend.football_match_players.edit');
    Route::put('football-match-players/{id}', [FootballMatchPlayersController::class, 'update'])->name('web.frontend.football_match_players.update');
    Route::get('football-match-players/{id}', [FootballMatchPlayersController::class, 'show'])->name('web.frontend.football_match_players.show');
    Route::delete('football-match-players/{id}', [FootballMatchPlayersController::class, 'delete'])->name('web.frontend.football_match_players.delete');
    Route::post('football-match-players/{id}/restore', [FootballMatchPlayersController::class, 'restore'])->name('web.frontend.football_match_players.restore');
});

