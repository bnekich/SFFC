<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [

    'default' => env('LOG_CHANNEL', 'stack'),

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily', 'audit'],
            'ignore_exceptions' => false,
        ],

        // File-based logging (general use)
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14, // Rotate logs daily, keep 14 days (adjust for dev)
        ],

        // Database logging (audit trail)
        'audit' => [
            'driver' => 'custom',
            'via' => App\Logging\DatabaseLogger::class,
            'level' => 'info',
        ],
    ],
];
