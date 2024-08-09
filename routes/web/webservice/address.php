<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebService\AddressController;


Route::prefix('ws')->group(function () {
    Route::get('address/find/{zip_code}', [AddressController::class, 'find'])->name('web.webservice.address.find');    
});
