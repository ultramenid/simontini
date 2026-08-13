<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'deforestory' => [
        'api_token' => env('DEFORESTORY_API_TOKEN'),
        'webhook_url' => env('ENDPOINT_PASOPATI')
            ?: env('DEFORESTORY_WEBHOOK_URL')
            ?: 'https://pasopati.id/api',
        'webhook_token' => env('DEFORESTORY_API_KEY', env('DEFORESTORY_WEBHOOK_TOKEN')),
        'webhook_timeout' => env('DEFORESTORY_WEBHOOK_TIMEOUT', 10),
    ],

    'cloudflare_d1' => [
        'account_id' => env('CLOUDFLARE_ACCOUNT_ID'),
        'database_id' => env('CLOUDFLARE_D1_DATABASE_ID'),
        'api_token' => env('CLOUDFLARE_D1_API_TOKEN'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],

    'turnstile' => [
        'site_key' => env('TURNSTILE_SITE_KEY'),
        'secret_key' => env('TURNSTILE_SECRET_KEY'),
    ],

];
