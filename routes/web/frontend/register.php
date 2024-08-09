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
use App\Http\Controllers\Frontend\Auth\RegisterController;
/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::middleware(['footballer_block'])->group(function () {
    Route::get('cadastro', [RegisterController::class, 'showRegistrationForm'])->name('web.frontend.register');
    Route::post('cadastro', [RegisterController::class, 'register']);
    Route::any('cadastro/validation', [RegisterController::class, 'validation'])->name('web.frontend.register.validation');
});