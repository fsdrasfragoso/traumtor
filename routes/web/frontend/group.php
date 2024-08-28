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
use App\Http\Controllers\Frontend\GroupController;


/*
|--------------------------------------------------------------------------
| Usuário
|--------------------------------------------------------------------------
*/

Route::prefix('usuario')->middleware(['auth:api,footballers', 'footballer_block'])->group(function () {
    Route::get('groups', [GroupController::class, 'index'])->name('web.frontend.groups.index');
    Route::get('groups/export', [GroupController::class, 'export'])->name('web.frontend.groups.export');
    Route::get('groups/create', [GroupController::class, 'create'])->name('web.frontend.groups.create');
    Route::post('groups', [GroupController::class, 'store'])->name('web.frontend.groups.store');
    Route::get('groups/{id}/edit', [GroupController::class, 'edit'])->name('web.frontend.groups.edit');
    Route::put('groups/{id}', [GroupController::class, 'update'])->name('web.frontend.groups.update');
    Route::get('groups/{id}', [GroupController::class, 'show'])->name('web.frontend.groups.show');
    Route::delete('groups/{id}', [GroupController::class, 'delete'])->name('web.frontend.groups.delete');
    Route::post('groups/{id}/restore', [GroupController::class, 'restore'])->name('web.frontend.groups.restore');
    
});