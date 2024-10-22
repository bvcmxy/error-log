# Installation

Run ``` composer require zf/error-log:dev-main```

Run ``` php artisan vendor:publish --tag=error-log-config```

Change config/error-log-config.php uri to point to error log server
```
return [
    'api_uri' => env('ERROR_LOG_API_URI'),
    'context' => [
        'application' => env('APP_NAME', 'default_app'),
        'env' => env('APP_ENV', 'production'),
        'type' => env('LOG_TYPE', 'general'),
        'version' => env('APP_VERSION', null),
        'user' => env('LOG_USER', null),
        'device' => env('LOG_DEVICE', null),
        'now' => env('LOG_NOW', \Carbon\Carbon::now()->toDateTimeString()),
    ]
];
```

Add in config/logging.php
```
 ...,
 'error-log' => [
        'driver' => 'custom',
        'via' => \Bvcmxy\ErrorLog\Logging\ErrorLogApi::class,
    ],
```

Changes in .env
```
LOG_CHANNEL=error-log
...
APP_VERSION=1.0.0
ERROR_LOG_API_URI=https://errorlog.zf-world.com/api/logs
```


