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
use App\Http\Controllers\Admin\GalleryController;

Route::prefix('admin')->group(function () {
    Route::middleware(['auth:users', 'cors'])->group(function () {        
       
        // Gallery routes
        Route::get('gallery', [GalleryController::class, 'index'])->name('web.admin.gallery.index');
        Route::get('gallery/browser', [GalleryController::class, 'browser'])->name('web.admin.gallery.browser');
        Route::post('gallery/store', [GalleryController::class, 'store'])->name('web.admin.gallery.store');
        Route::delete('gallery/destroy/{id}', [GalleryController::class, 'destroy'])->name('web.admin.gallery.destroy');
        Route::post('gallery/fileupload', [GalleryController::class, 'fileUpload'])->name('web.admin.gallery.fileupload');
    });
});
