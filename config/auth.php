<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'passport',
            'provider' => 'admins',
        ],
        'mentor' => [
            'driver' => 'passport',
            'provider' => 'mentors',
        ],

        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\User::class
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Admin::class
        ],
        'mentors' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Mentor::class
        ]
    ],
];
