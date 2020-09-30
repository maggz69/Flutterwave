<?php

return [
    'keys'=> [
        'secret_key'=> env('FLUTTERWAVE_PUBLIC_KEY', null),
    ],
    'urls'=> [
        'base_url'=> 'https://api.ravepay.co/',
    ],
    'environment'=> [
        'version' => env('FLUTTERWAVE_API_VERSION', 'v2'),
        'instance'=> env('FLUTTERWAVE_INSTANCE', 'test'),
    ],
];
