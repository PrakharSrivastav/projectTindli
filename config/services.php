<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '471249073065747',
        'client_secret' => '712f52b8cfe7e0c9c81cae040f26794b',
        'redirect' => 'http://tindli.app/auth/facebook/callback',
    ],
    'google' => [
        'client_id' => '890308540213-pp41u1csa2slcanc92n30jfdlhvbij2g.apps.googleusercontent.com',
        'client_secret' => 'QnfVlJnAlmPUSvrWFZMl9sAa',
        'redirect' => 'http://tindli.app/auth/google/callback',
    ],
];
