<?php

declare(strict_types=1);

namespace Bvcmxy\ErrorLog\Tests;

use Orchestra\Testbench\TestCase;
use Bvcmxy\ErrorLog\Providers\PackageServiceProvider;

class PackageTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            PackageServiceProvider::class
        ];
    }
}
