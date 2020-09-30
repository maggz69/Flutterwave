<?php

return [
    'base_url'   => 'https://api.flutterwave.com',
    'api_version'=> 'v3',
    'keys'       => [
        'public_key'=> env('FLUTTERWAVE_SECRET_KEY', null),
    ],
];
