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
use App\Http\Controllers\Frontend\FootballerController;

Route::prefix('footballer')->middleware(['apiJwt','cors'])->group(function () {
    Route::get('/data-logged', [FootballerController::class, 'getLoggedFootballer'])->name('api.frontend.footballers.getLoggedFootballer');;
});



