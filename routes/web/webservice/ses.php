<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebService\Webhook\SesController;

Route::prefix('ws')->group(function () {    
    Route::post('webhooks/ses', [SesController::class, 'store'])->name('web.webservice.webhooks.ses');
});
