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
use App\Http\Controllers\Admin\DefaultController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users','cors'])->group(function () {
        Route::get('/', [DefaultController::class, 'show'])->name('web.admin.default.show');
        Route::get('clear-cache', [DefaultController::class, 'clearCache']);
        Route::get('info', [DefaultController::class, 'info'])->name('web.admin.default.info');
    });
});
