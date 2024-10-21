<?php

declare(strict_types=1);

namespace Bvcmxy\ErrorLog\ErrorLog;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Bvcmxy\ErrorLog\Constants\ErrorLogLevels;
use Bvcmxy\ErrorLog\Dto\ErrorLogDto;
use Bvcmxy\ErrorLog\Services\ErrorLogService;

class ErrorLogApp
{
    /**
     * @var array<string, string>
     */
    public array $config = [];

    private ErrorLogService $errorLogService;

    public function __construct()
    {
        $this->config = config('error-log-config');
        $client = new Client(
            [
                'timeout' => 2.0,
            ]
        );
        $this->errorLogService = new ErrorLogService($this->config, $client);
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function emergency(
        string $application,
        string $description,
        string $env,
        string $type,
        string|null $trace = null,
        string|null $version = null,
        Carbon|null $date = null,
        string|null $user = null,
        string|null $device = null
    ): void {
        $this->log(
            $application,
            ErrorLogLevels::EMERGENCY,
            $description,
            $env,
            $type,
            $trace,
            $version,
            $date,
            $user,
            $device
        );
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function alert(
        string $application,
        string $description,
        string $env,
        string $type,
        string|null $trace = null,
        string|null $version = null,
        Carbon|null $date = null,
        string|null $user = null,
        string|null $device = null
    ): void {
        $this->log(
            $application,
            ErrorLogLevels::ALERT,
            $description,
            $env,
            $type,
            $trace,
            $version,
            $date,
            $user,
            $device
        );
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function critical(
        string $application,
        string $description,
        string $env,
        string $type,
        string|null $trace = null,
        string|null $version = null,
        Carbon|null $date = null,
        string|null $user = null,
        string|null $device = null
    ): void {
        $this->log(
            $application,
            ErrorLogLevels::CRITICAL,
            $description,
            $env,
            $type,
            $trace,
            $version,
            $date,
            $user,
            $device
        );
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function error(
        string $application,
        string $description,
        string $env,
        string $type,
        string|null $trace = null,
        string|null $version = null,
        Carbon|null $date = null,
        string|null $user = null,
        string|null $device = null
    ): void {
        $this->log(
            $application,
            ErrorLogLevels::ERROR,
            $description,
            $env,
            $type,
            $trace,
            $version,
            $date,
            $user,
            $device
        );
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function warning(
        string $application,
        string $description,
        string $env,
        string $type,
        string|null $trace = null,
        string|null $version = null,
        Carbon|null $date = null,
        string|null $user = null,
        string|null $device = null
    ): void {
        $this->log(
            $application,
            ErrorLogLevels::WARNING,
            $description,
            $env,
            $type,
            $trace,
            $version,
            $date,
            $user,
            $device
        );
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function notice(
        string $application,
        string $description,
        string $env,
        string $type,
        string|null $trace = null,
        string|null $version = null,
        Carbon|null $date = null,
        string|null $user = null,
        string|null $device = null
    ): void {
        $this->log(
            $application,
            ErrorLogLevels::NOTICE,
            $description,
            $env,
            $type,
            $trace,
            $version,
            $date,
            $user,
            $device
        );
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function info(
        string $application,
        string $description,
        string $env,
        string $type,
        string|null $trace = null,
        string|null $version = null,
        Carbon|null $date = null,
        string|null $user = null,
        string|null $device = null
    ): void {
        $this->log(
            $application,
            ErrorLogLevels::INFO,
            $description,
            $env,
            $type,
            $trace,
            $version,
            $date,
            $user,
            $device
        );
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function debug(
        string $application,
        string $description,
        string $env,
        string $type,
        string|null $trace = null,
        string|null $version = null,
        Carbon|null $date = null,
        string|null $user = null,
        string|null $device = null
    ): void {
        $this->log(
            $application,
            ErrorLogLevels::DEBUG,
            $description,
            $env,
            $type,
            $trace,
            $version,
            $date,
            $user,
            $device
        );
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function log(
        string $application,
        string $level,
        string $description,
        string $env,
        string $type,
        string|null $trace = null,
        string|null $version = null,
        Carbon|null $date = null,
        string|null $user = null,
        string|null $device = null
    ): void {
        $logDto = new ErrorLogDto(
            $application,
            $level,
            $description,
            $env,
            $type,
            $trace,
            $version,
            $date,
            $user,
            $device
        );
        $this->errorLogService->log($logDto);
    }
}
