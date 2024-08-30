<?php

declare(strict_types=1);

namespace Bvcmxy\ErrorLog\Facades;

use Carbon\Carbon;
use Illuminate\Support\Facades\Facade;
use Bvcmxy\ErrorLog\ErrorLog\ErrorLogApp;

/**
 * @method static emergency(string $application,string $description, string $env, string $type, string|null $trace = null, string|null $version = null, Carbon|null $date = null, string|null $user = null, string|null $device = null)
 * @method static alert(string $application,string $description, string $env, string $type, string|null $trace = null, string|null $version = null, Carbon|null $date = null, string|null $user = null, string|null $device = null)
 * @method static critical(string $application,string $description, string $env, string $type, string|null $trace = null, string|null $version = null, Carbon|null $date = null, string|null $user = null, string|null $device = null)
 * @method static error(string $application,string $description, string $env, string $type, string|null $trace = null, string|null $version = null, Carbon|null $date = null, string|null $user = null, string|null $device = null)
 * @method static warning(string $application,string $description, string $env, string $type, string|null $trace = null, string|null $version = null, Carbon|null $date = null, string|null $user = null, string|null $device = null)
 * @method static notice(string $application,string $description, string $env, string $type, string|null $trace = null, string|null $version = null, Carbon|null $date = null, string|null $user = null, string|null $device = null)
 * @method static info(string $application,string $description, string $env, string $type, string|null $trace = null, string|null $version = null, Carbon|null $date = null, string|null $user = null, string|null $device = null)
 * @method static debug(string $application,string $description, string $env, string $type, string|null $trace = null, string|null $version = null, Carbon|null $date = null, string|null $user = null, string|null $device = null)
 * @method static log(string $application,string $level, string $description, string $env, string $type, string|null $trace = null, string|null $version = null, Carbon|null $date = null, string|null $user = null, string|null $device = null)
 */
class ErrorLog extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ErrorLogApp::class;
    }
}
