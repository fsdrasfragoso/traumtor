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
use App\Http\Controllers\Frontend\ProfileController;
/*
|--------------------------------------------------------------------------
| Usuário
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api,footballers', 'footballer_block'])->group(function () {
    Route::get('/', function() {
        return redirect()->route('web.frontend.profiles.show');
    })->name('web.frontend.default.index');
});


Route::prefix('usuario')->middleware(['auth:api,footballers', 'footballer_block'])->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('web.frontend.profiles.show');

    Route::get('editar', [ProfileController::class, 'edit'])->name('web.frontend.profiles.edit');
    Route::put('editar', [ProfileController::class, 'update'])->name('web.frontend.profiles.update');    
    Route::get('foto', [ProfileController::class, 'editAvatar'])->name('web.frontend.profiles.editAvatar');
    Route::put('foto', [ProfileController::class, 'updateAvatar'])->name('web.frontend.profiles.updateAvatar');
    Route::delete('foto', [ProfileController::class, 'deleteAvatar'])->name('web.frontend.profiles.deleteAvatar');
    
});