<?php

use App\Http\Controllers\HomeController;

define('CONFIG_ROUTES', [
    'GET' => [

        [
            'path' => '/teste',
            'controller' => HomeController::class,
            'method' => 'test'
        ],

        [
            'path' => '/',
            'controller' => HomeController::class,
            'method' => 'index'
        ]
    ]
]);
