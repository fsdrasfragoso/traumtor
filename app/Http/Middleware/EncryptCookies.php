<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        'my_content',
        'ads-closed',
        'order_by',
        'content_format',
        'content_paid',
        'daterange',
        'content_period',
        'permission_use_cookies',
        'credits'
    ];
}
