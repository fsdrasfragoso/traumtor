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
use App\Http\Controllers\Admin\SettingController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users','cors'])->group(function () {     
        Route::get('settings/features', [SettingController::class, 'features'])->name('web.admin.settings.features');
        Route::put('settings/features', [SettingController::class, 'features']);
        Route::get('settings/blocks', [SettingController::class, 'blocks'])->name('web.admin.settings.blocks');
        Route::put('settings/blocks', [SettingController::class, 'blocks']);
    });
});
