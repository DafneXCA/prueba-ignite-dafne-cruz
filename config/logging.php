<?php

use Monolog\Handler\NullHandler;

return [
    'default' => env('LOG_CHANNEL', 'null'),
    'channels' => [
        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],
        'stderr' => [
            'driver' => 'monolog',
            'handler' => Monolog\Handler\StreamHandler::class,
            'with' => ['stream' => 'php://stderr'],
        ],
    ],
];
