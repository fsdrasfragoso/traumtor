<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tests
|--------------------------------------------------------------------------
*/

Route::get('/testing/erp/contract/{id}/cycle/{cicle}', function () {
    $html = 'Hello Test';

    return response(
        $html,
        503
    );
});
