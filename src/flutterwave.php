<?php

return [
    'base_url' => 'https://api.flutterwave.com',
    'api_version' => 'v3',
    'keys' => [
        'secret_key' => env('FLUTTERWAVE_SECRET_KEY', null)
    ],
    "environment" => [
        "instance" => env("FLUTTERWAVE_INSTANCE", "production")
    ]
];

