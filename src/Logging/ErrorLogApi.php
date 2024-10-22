<?php
declare(strict_types=1);

namespace Bvcmxy\ErrorLog\Logging;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Bvcmxy\ErrorLog\Services\ErrorLogService;
use Bvcmxy\ErrorLog\Dto\ErrorLogDto;
use Carbon\Carbon;

class ErrorLogApi extends AbstractProcessingHandler implements LoggerInterface
{
    use LoggerTrait;

    protected ErrorLogService $errorLogService;

    public function __construct(ErrorLogService $errorLogService, $level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->errorLogService = $errorLogService;
    }

    public function __invoke(array $config)
    {
        return new static($this->errorLogService);
    }

    protected function write(array $record): void
    {
        $contextConfig = config('error-log-config.context');

        $context = [
            'application' => $contextConfig['application'] ?? 'default_app',
            'env' => $contextConfig['env'] ?? 'production',
            'type' => $contextConfig['type'] ?? 'general',
            'version' => $contextConfig['version'] ?? null,
            'user' => $contextConfig['user'] ?? null,
            'device' => $contextConfig['device'] ?? null,
        ];

        $errorLogDto = new ErrorLogDto(
            $context['application'],
            $record['level_name'],
            $record['message'],
            $context['env'],
            $context['type'],
            $record['context']['trace'] ?? null,
            $context['version'],
            Carbon::now(),
            $context['user'],
            $context['device']
        );

        $this->errorLogService->log($errorLogDto);
    }

    public function log($level, Stringable|string $message, array $context = []))
    {
        $this->write([
            'level_name' => $level,
            'message' => $message,
            'context' => $context,
        ]);
    }
}
