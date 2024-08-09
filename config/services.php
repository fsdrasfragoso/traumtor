<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */
    'ses' => [
        'key' => env('SES_AWS_ACCESS_KEY_ID'),
        'secret' => env('SES_AWS_SECRET_ACCESS_KEY'),
        'region' => env('SES_AWS_DEFAULT_REGION', 'us-east-1'),
        'webhook' => [
            'secret' => env('SES_WEBHOOK_SECRET', ''),
        ]
    ],
    'asaas' => [
        'base_uri' => env('ASAAS_BASE_URI'),
        'api_key' => env('ASAAS_API_KEY'),
        'prefix' => env('ASAAS_PREFIX'),
        'webhook' => [
            'secret' => env('ASAAS_WEBHOOK_SECRET'),
        ],
    ],
    'viacep' => [
        'url' => 'https://viacep.com.br/ws/',
    ],
];
