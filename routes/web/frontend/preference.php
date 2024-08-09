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
use App\Http\Controllers\Frontend\PreferenceController;
/*
|--------------------------------------------------------------------------
| Usuário
|--------------------------------------------------------------------------
*/

Route::prefix('usuario')->middleware(['auth:api,footballers', 'footballer_block'])->group(function () {
    Route::get('preferencias', [PreferenceController::class, 'edit'])->name('web.frontend.preferences.edit');
    Route::put('preferencias', [PreferenceController::class, 'update'])->name('web.frontend.preferences.update');    
});