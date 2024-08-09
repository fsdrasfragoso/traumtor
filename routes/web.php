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

require_once __DIR__ . '/web/admin.php';
require_once __DIR__ . '/web/checkout.php';
require_once __DIR__ . '/web/webservice.php';
require_once __DIR__ . '/web/frontend.php';

if (env('APP_ENV') == 'testing') {
    require_once __DIR__ . '/web/tests.php';
}
