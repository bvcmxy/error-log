<?php

declare(strict_types=1);

namespace Bvcmxy\ErrorLog\Providers;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Publish a config file
        $configPath = __DIR__.'/../../config/error-log-config.php';
        $this->publishes([
            $configPath => config_path('error-log-config.php'),
        ], 'error-log-config');
    }
}
