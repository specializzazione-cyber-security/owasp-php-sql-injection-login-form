<?php

return [
    'default' => [
        'channel' => 'default',
        'path' => storagePath('logs/core.log'),
        'level' => $_ENV['LOG_LEVEL'],
    ],
    'daily' => [
        'channel' => 'daily',
        'path' => storagePath('logs/core.log'),
        'level' => $_ENV['LOG_LEVEL'],
    ],
];
