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
use App\Http\Controllers\Admin\FootballerController;



Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users','cors'])->group(function () { 

        Route::get('footballers', [FootballerController::class, 'index'])->name('web.admin.footballers.index');
        Route::get('footballers/export', [FootballerController::class, 'export'])->name('web.admin.footballers.export');
        Route::get('footballers/create', [FootballerController::class, 'create'])->name('web.admin.footballers.create');
        Route::post('footballers', [FootballerController::class, 'store'])->name('web.admin.footballers.store');
        Route::get('footballers/{id}/edit', [FootballerController::class, 'edit'])->name('web.admin.footballers.edit');
        Route::put('footballers/{id}', [FootballerController::class, 'update'])->name('web.admin.footballers.update');
        Route::any('footballers/validation/{id?}', [FootballerController::class, 'validation'])->name('web.admin.footballers.validation');
        Route::get('footballers/{id}', [FootballerController::class, 'show'])->name('web.admin.footballers.show');
        Route::get('footballers/{id}/login', [FootballerController::class, 'login'])->name('web.admin.footballers.login');
        Route::put('footballers/{id}/change', [FootballerController::class, 'change'])->name('web.admin.footballers.change');
        Route::post('footballers/{id}/subscribe', [FootballerController::class, 'subscribe'])->name('web.admin.footballers.subscribe');        
        Route::post('footballers/{id}/access', [FootballerController::class, 'access'])->name('web.admin.footballers.access');
        Route::post('footballers/{id}/activity', [FootballerController::class, 'activity'])->name('web.admin.footballers.activity');
        Route::delete('footballers/{id}/payment_profiles/{payment_id}', [FootballerController::class, 'deletePaymentProfile'])->name('web.admin.footballers.delete_payment_profile');
        Route::get('footballers/{id}/confirm_address', [FootballerController::class, 'confirmAddress'])->name('web.admin.footballers.confirm_address');
       

    });
});