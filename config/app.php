<?php

define('CONFIG_APP', [
    'brokerServiceHost' => 'http://broker-service:8081',
    'kafkaServiceHost' => 'http://kafka:9092',
    
    'database' => [
        'connections' => [
            'default' => [
                'host' => 'kafka-ms-broker-db',
                'port' => 5432,
                'user' => 'test',
                'password' => 'test',
                'db' => 'Broker',
            ]
        ]
    ]
]);
