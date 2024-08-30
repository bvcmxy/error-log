# Installation

Add in composer.json
```
    "repositories": [
        {
            "type": "vcs",
            "url": "https://ZF-DevOps-Platform-nonembedded@dev.azure.com/ZF-DevOps-Platform-nonembedded/AZP-2003_DivA_TEC_Digital_Solutions/_git/DAG_ErrorLog_Laravel_Library"
        }
    ],
```

Run ``` composer require zf/error-log:dev-main```

Run ``` php artisan vendor:publish --tag=error-log-config```

Change config/error-log-config.php uri to point to error log server
```
return [
    'hostData' => [
        'uri' => 'https://errorlog.zf-world.com/api/logs',
    ]
];
```
