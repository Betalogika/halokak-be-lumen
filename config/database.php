<?php

return [
    "default" => env('DB_CONNECTION', 'mysql'),
    'migrations' => 'migrations',
    "connections" => [
        "mongodb" => [
            "driver" => "mongodb",
            "dsn" => env('MONGODB_URL', 'insert env mongo'),
            "database" => env('MONGODB_DATABASE', 'mongo db'),
            'port' => env('MONGODB_PORT', 'insert port'),
        ],
        "mysql" => [
            'driver'    => env('DB_CONNECTION', 'connection db'),
            'host'      => env('DB_HOST', 'host'),
            'port'      => env('DB_PORT', 'port db'),
            'database'  => env('DB_DATABASE', 'name db'),
            'username'  => env('DB_USERNAME', 'username db'),
            'password'  => env('DB_PASSWORD', 'password db'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ]
];
