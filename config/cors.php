<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Options
    |--------------------------------------------------------------------------
    |
    | The allowed_methods and allowed_headers options are set to the wildcard
    | options (*) by default. For most projects, these two options should be
    | fine. However, if you need to be more specific, you can specify certain
    | methods or headers.
    |
    */

    'paths' => ['api/*', '/storytoday','assets/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];