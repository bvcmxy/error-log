<?php

declare(strict_types=1);

namespace Bvcmxy\ErrorLog\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use Bvcmxy\ErrorLog\Services\ErrorLogService;

class PackageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Publish a config file
        $configPath = __DIR__ . '/../../config/error-log-config.php';
        $this->publishes([
            $configPath => config_path('error-log-config.php'),
        ], 'error-log-config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/error-log-config.php', 'error-log-config'
        );


        $this->app->singleton(ErrorLogService::class, function ($app) {
            $config = [
                'uri' => config('error-log-config.api_uri'),
            ];
            return new ErrorLogService($config, new Client());
        });
    }
}
