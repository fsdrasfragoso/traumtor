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
use App\Http\Controllers\Admin\MediaController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users','cors'])->group(function () {
        Route::delete('medias/{id}', [MediaController::class, 'delete'])->name('web.admin.medias.delete');
    });
});
