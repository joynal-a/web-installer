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
    | minimum php version
    |--------------------------------------------------------------------------
    */
    'minPhpVersion' => '8.2.0',

    /*
    |--------------------------------------------------------------------------
    | Php and server Requirements
    |--------------------------------------------------------------------------
    | php extensions and apache modules requirements
    */
    'php_extensions' => [
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
        'bcMath',
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
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
    | environment form fields
    |
    */
    'environment_fields' => [
        [
            'app_name' => [
                'rule' => 'required|string|max:50',
                'label' => 'App name',
                'placeholder' => 'e.g: Web-installer',
                'type' => 'text'
            ],
            'app_url' => [
                'rule' => 'required|url',
                'label' => 'App base url',
                'placeholder' => 'e.g: http://example.com',
                'type' => 'text'
            ],
            'environment' => [
                'rule' => 'required|string|max:50',
                'label' => 'App eneverment',
                'placeholder' => 'Select app enverment',
                'type' => 'select',
                'option' => ['local', 'production', 'staging', 'development']
            ],
            'filesystem_disk' => [
                'rule' => 'required|string',
                'label' => 'App file system',
                'placeholder' => 'Select a file system',
                'type' => 'select',
                'option' => ['local', 'public']
            ],
            'debug' => [
                'rule' => 'required|string',
                'label' => 'App debug:',
                'placeholder' => 'Choose app debug mode',
                'option' => [true, false],
                'type' => 'radio'
            ],
        ],[
            'database_connection' => [
                'rule' => 'required|string|max:50',
                'label' => 'Database Connection',
                'placeholder' => 'Select Databese',
                'type' => 'select',
                'option' => ['mysql', 'sqlite', 'pgsql', 'sqlsrv']
            ],
            'database_hostname' => [
                'rule' => 'required|string|max:50',
                'label' => 'Database Host',
                'type' => 'text',
                'placeholder' => 'e.g: 127.0.0.1'
            ],
            'database_port' => [
                'rule' => 'required|numeric',
                'label' => 'Database Port',
                'type' => 'number',
                'placeholder' => 'e.g: 3306',
            ],
            'database_name' => [
                'rule' => 'required|string|max:50',
                'label' => 'Database Name',
                'type' => 'text',
                'placeholder' => 'e.g: web_installer'
            ],
            'database_username' => [
                'rule' => 'required|string|max:50',
                'label' => 'Database Username',
                'type' => 'text',
                'placeholder' => 'e.g: root'
            ],
            'database_password' => [
                'rule' => 'required|string|max:50',
                'label' => 'Database Password',
                'type' => 'password',
                'placeholder' => 'e.g: **********'
            ],
        ],[
            'mail_driver' => [
                'rule' => 'required|string|max:50',
                'label' => 'Mail Driver',
                'type' => 'text',
                'placeholder' => 'e.g: smtp'
            ],
            'mail_host' => [
                'rule' => 'required|string|max:50',
                'label' => 'Mail Host',
                'type' => 'text',
                'placeholder' => 'e.g: smtp.gmail.com'
            ],
            'mail_port' => [
                'rule' => 'required|string|max:50',
                'label' => 'Mail Port',
                'type' => 'number',
                'placeholder' => 'e.g: 587'
            ],
            'mail_username' => [
                'rule' => 'required|string|max:50',
                'label' => 'Mail Username',
                'type' => 'text',
                'placeholder' => 'e.g: example@gmail.com'
            ],
            'mail_password' => [
                'rule' => 'required|string|max:50',
                'label' => 'Mail Password',
                'type' => 'password',
                'placeholder' => 'e.g: **********'
            ],
            'mail_encryption' => [
                'rule' => 'required|string|max:50',
                'label' => 'Mail Encryption',
                'type' => 'text',
                'placeholder' => 'e.g: TLS|SSL'
            ],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Applications User access
    |--------------------------------------------------------------------------
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
