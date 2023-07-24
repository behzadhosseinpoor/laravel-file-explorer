<?php

return [
    'domain' => env('FILE_EXPLORER_DOMAIN'),
    'path' => env('FILE_EXPLORER_PATH', 'file-explorer'),
    'enabled' => env('FILE_EXPLORER_ENABLED', true),
    'disks' => [
        'local',
        'public',
        's3'
    ],
    'middleware' => [
        'web'
    ],
];
