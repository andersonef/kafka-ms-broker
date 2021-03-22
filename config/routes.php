<?php

use App\Http\Controllers\RequestController;

define('CONFIG_ROUTES', [
    'POST' => [
        [
            'path' => '/request',
            'controller' => RequestController::class,
            'method' => 'store'
        ]
    ],
    'GET' => [
        [
            'path' => '/request',
            'controller' => RequestController::class,
            'method' => 'read'
        ]
    ]    
]);
