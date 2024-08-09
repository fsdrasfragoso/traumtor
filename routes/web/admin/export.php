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
use App\Http\Controllers\Admin\ExportController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users','cors'])->group(function () {
        Route::get('exports', [ExportController::class, 'index'])->name('web.admin.exports.index');
        Route::get('exports/{export}/download', [ExportController::class, 'download'])->name('web.admin.exports.download');
    });
});
