<?php

return [
    'role_ids' => [
        'admin' => (int) env('CMS_ADMIN_ROLE_ID', 1),
        'user' => (int) env('CMS_USER_ROLE_ID', 2),
        'editor' => (int) env('CMS_EDITOR_ROLE_ID', 3),
    ],

    'basic_auth' => [
        'user' => env('STADI_BASIC_USER'),
        'password' => env('STADI_BASIC_PASS'),
    ],
];
