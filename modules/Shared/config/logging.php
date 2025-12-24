<?php

return [
    'channels' => [
        'shared' => [
            'driver' => 'stack',
            'channels' => ['single'], // Default to single file, can be overridden by main app
            'ignore_exceptions' => false,
        ],
    ],
];
