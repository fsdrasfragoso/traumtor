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
use App\Http\Controllers\Frontend\ModalityController;

Route::prefix('modality')->middleware(['apiJwt','cors'])->group(function () {
    Route::get('/all', [ModalityController::class, 'all'])->name('api.frontend.modalities.all');
});



