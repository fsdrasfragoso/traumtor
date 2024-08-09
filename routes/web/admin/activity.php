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
use App\Http\Controllers\Admin\ActivityController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users','cors'])->group(function () {
        Route::get('activities', [ActivityController::class, 'index'])->name('web.admin.activities.index');
        Route::get('activities/export', [ActivityController::class, 'export'])->name('web.admin.activities.export');
     });
});
