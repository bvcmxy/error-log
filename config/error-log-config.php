<?php

declare(strict_types=1);

return [
    'api_uri' => env('ERROR_LOG_API_URI'),
    'context' => [
        'application' => env('APP_NAME', 'default_app'),
        'env' => env('APP_ENV', 'production'),
        'type' => env('LOG_TYPE', 'general'),
        'version' => env('APP_VERSION', null),
        'user' => env('LOG_USER', null),
        'device' => env('LOG_DEVICE', null),
        'now' => env('LOG_NOW', Carbon::now()->toDateTimeString()),
    ]
];

