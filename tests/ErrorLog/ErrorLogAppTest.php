<?php

declare(strict_types=1);

use Bvcmxy\ErrorLog\ErrorLog\ErrorLogApp;

beforeEach(function () {
    config(['error-log-config.hostData' => [
        'uri' => 'http://localhost/api/logs',
    ]]);
});
it('just test', function () {
    $errorLogApp = new ErrorLogApp();
    expect($errorLogApp->config)->not()->toBeEmpty()
        ->and($errorLogApp->config['uri'])->toBe('http://localhost/api/logs');
});
