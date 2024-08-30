<?php

declare(strict_types=1);

namespace Bvcmxy\ErrorLog\Dto;

use Carbon\Carbon;

class ErrorLogDto
{
    public function __construct(
        public string $application,
        public string $level,
        public string $description,
        public string $env,
        public string $type,
        public string|null $trace = null,
        public string|null $version = null,
        public Carbon|null $date = null,
        public string|null $user = null,
        public string|null $device = null
    ) {
    }
}
