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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'github' => [
    'client_id' => 'de4d9daabed823b07fdf',
    'client_secret' => 'c2c530c91b55d7db8702006f36c5cdaca6425426',
    'redirect' => 'http://localhost:8000/retorno/github',
    ],

    'facebook' => [
    'client_id' => '285246775319242',
    'client_secret' => 'c4c088fae96cfe396c6233f148877297',
    'redirect' => 'http://localhost:8000/retorno/facebook',
    ],

];
