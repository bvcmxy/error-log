<?php

declare(strict_types=1);

namespace Bvcmxy\ErrorLog\Services;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Bvcmxy\ErrorLog\Dto\ErrorLogDto;

class ErrorLogService
{
    /**
     * @var array<string, string>
     */
    private array $headers = [
        'content-type' => 'application/json',
    ];

    /**
     * @param  array<string, string>  $config
     */
    public function __construct(
        private array $config,
        private Client $client
    ) {
    }

    /**
     * @throws \JsonException
     * @throws GuzzleException
     */
    public function log(ErrorLogDto $errorLogDto): void
    {
        $errorLogArray = (array) $errorLogDto;
        $errorLogArray = array_filter($errorLogArray, static function ($value) {
            return $value !== null;
        });
        if (array_key_exists('date', $errorLogArray)) {
            /** @var Carbon $date */
            $date = $errorLogArray['date'];
            $errorLogArray['date'] = $date->format('Y-m-d H:i:s');
        }
        $body = json_encode($errorLogArray, JSON_THROW_ON_ERROR);
        $response = $this->client->post(
            $this->config['uri'],
            [
                'headers' => $this->headers,
                'body' => $body,
            ]
        );
        if ($response->getStatusCode() !== Response::HTTP_CREATED) {
            Log::error('Creating log failed. Post to ' . $this->config['uri'] . ' with Body:');
            Log::error(print_r($body, true));
            Log::error('Response: ');
            Log::error(print_r($response, true));
        }
    }
}
