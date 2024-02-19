<?php

return [

    'name' => 'Laravel Web Installer',

    'redirect_route' => "welcome",

    /*
    |--------------------------------------------------------------------------
    | Market place validation
    |--------------------------------------------------------------------------
    */
    'with_purchase_code' => false,
    'market_name' => 'Codecanyon',

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    */
    'core' => [
        'minPhpVersion' => '8.1.0',
    ],

    /*
    |--------------------------------------------------------------------------
    | Php and server Requirements
    |--------------------------------------------------------------------------
    |
    | php extensions and apache modules requirements
    |
    */
    'requirements' => [
        'php' => [
            'mysqli',
            'openssl',
            'pdo',
            'mbstring',
            'JSON',
            'cURL',
            'fileinfo',
            'gmp',
            'xml',
            'zip',
            'sodium',
            'bcMath'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
    */
    'permissions' => [
        'storage/framework/' => 755,
        'storage/logs/' => 777,
        'bootstrap/cache/' => 655
    ],

    /*
    |--------------------------------------------------------------------------
    | Environment Form
    |--------------------------------------------------------------------------
    |
    | environment form fields
    |
    */
    'environment'  => [
        'form' => [
            'app_name'              => 'required|string|max:50',
            'environment'           => 'required|string|max:50',
            'debug'                 => 'required|string',
            'app_url'               => 'required|url',

            'database_connection'   => 'required|string|max:50',
            'database_hostname'     => 'required|string|max:50',
            'database_port'         => 'required|numeric',
            'database_name'         => 'required|string|max:50',
            'database_username'     => 'required|string|max:50',
            'database_password'     => 'nullable|string|max:50',

            'mail_driver'           => 'required|string|max:50',
            'mail_host'             => 'required|string|max:50',
            'mail_port'             => 'required|string|max:50',
            'mail_username'         => 'required|string|max:50',
            'mail_password'         => 'required|string|max:50',
            'mail_encryption'       => 'required|string|max:50',

            'pusher_app_id'         => 'max:50',
            'pusher_app_key'        => 'max:50',
            'pusher_app_secret'     => 'max:50',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Applications Form
    |--------------------------------------------------------------------------
    |
    | applications form fields
    |
    */
    'users' => [
        'root' => [
            'name' => 'Joynal Abedin',
            'email' => 'abedin.dev@gmail.com',
            'password' => 'secret',
            'email_verified_at' => now()
        ]
    ]
];
