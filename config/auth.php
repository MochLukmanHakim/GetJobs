<?php

return [

    'defaults' => [
        'guard' => 'pelamar',
        'passwords' => 'pelamars',
    ],

    'guards' => [
        'pelamar' => [
            'driver' => 'session',
            'provider' => 'pelamars',
        ],
    ],

    'providers' => [
        'pelamars' => [
            'driver' => 'eloquent',
            'model' => App\Models\Pelamar::class,
        ],
    ],

    'passwords' => [
        'pelamars' => [
            'provider' => 'pelamars',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
