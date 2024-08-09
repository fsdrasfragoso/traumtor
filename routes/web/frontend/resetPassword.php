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
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;
/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::middleware(['footballer_block'])->group(function () {
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('web.frontend.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('web.frontend.password.update');
});