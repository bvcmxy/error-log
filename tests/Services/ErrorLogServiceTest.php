<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Bvcmxy\ErrorLog\Constants\ErrorLogLevels;
use Bvcmxy\ErrorLog\Dto\ErrorLogDto;
use Bvcmxy\ErrorLog\Services\ErrorLogService;

beforeEach(function () {
    config(['error-log-config.hostData' => [
        'uri' => 'http://localhost:8000/api/logs',
    ]]);
});

it('should log error only with mandatory file', function () {
    $data = new ErrorLogDto(
        'application new',
        ErrorLogLevels::CRITICAL,
        'Description',
        'Local',
        'Web'
    );
//    $client = Mockery::mock(Client::class);
//    $client->allows('post');
    $client = new Client(
        [
            'timeout' => 2.0,
        ]
    );

    $errorLogService = new ErrorLogService(config('error-log-config.hostData'), $client);

    $error = '';

    try {
        $errorLogService->log($data);
    } catch (Exception|GuzzleException $exception) {
        $error = $exception->getMessage();
    }
    expect($error)->toBeEmpty();
//    $client->expects('post');

    Mockery::close();
});

it('should log error only with date', function () {
    $data = new ErrorLogDto(
        'application new',
        ErrorLogLevels::INFO,
        'Description',
        'Local',
        'Web',
        '',
        '1.0',
        \Carbon\Carbon::now(),
        'local',
        'testing'
    );
//    $client = Mockery::mock(Client::class);
//    $client->allows('post');
    $client = new Client(
        [
            'timeout' => 2.0,
        ]
    );

    $errorLogService = new ErrorLogService(config('error-log-config.hostData'), $client);

    $error = '';

    try {
        $errorLogService->log($data);
    } catch (Exception|GuzzleException $exception) {
        $error = $exception->getMessage();
    }
    expect($error)->toBeEmpty();
//    $client->expects('post');

    Mockery::close();
});
