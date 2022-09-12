<?php

return [
    'defaults' => [
        'guard' => 'jwtapi',
        'passwords' => 'users',
    ],

    'guards' => [
        'jwtapi' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\User::class
        ]
    ]
];
