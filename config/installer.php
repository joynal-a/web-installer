<?php

return [

    'name' => 'Laravel Web Installer',

     /*
    |--------------------------------------------------------------------------
    | Seeder run permission here
    |--------------------------------------------------------------------------
    */
    'seeder_run' => true,

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
            'APP_NAME' => [
                'rule' => 'required|string|max:50',
                'label' => 'App name',
                'placeholder' => 'e.g: Web-installer',
                'type' => 'text'
            ],
            'APP_URL' => [
                'rule' => 'required|url',
                'label' => 'App base url',
                'placeholder' => 'e.g: http://example.com',
                'type' => 'text'
            ],
            'APP_ENV' => [
                'rule' => 'required|string|max:50',
                'label' => 'App eneverment',
                'placeholder' => 'Select app enverment',
                'type' => 'select',
                'option' => ['local', 'production', 'staging', 'development']
            ],
            'FILESYSTEM_DISK' => [
                'rule' => 'required|string',
                'label' => 'App file system',
                'placeholder' => 'Select a file system',
                'type' => 'select',
                'option' => ['local', 'public']
            ],
            'APP_DEBUG' => [
                'rule' => 'required|string',
                'label' => 'App debug:',
                'placeholder' => 'Choose app debug mode',
                'option' => [true, false],
                'type' => 'radio'
            ],
        ],[
            'DB_CONNECTION' => [
                'rule' => 'required|string|max:50',
                'label' => 'Database Connection',
                'placeholder' => 'Select Databese',
                'type' => 'select',
                'option' => ['mysql', 'sqlite', 'pgsql', 'sqlsrv']
            ],
            'DB_HOST' => [
                'rule' => 'required|string|max:50',
                'label' => 'Database Host',
                'type' => 'text',
                'placeholder' => 'e.g: 127.0.0.1'
            ],
            'DB_PORT' => [
                'rule' => 'required|numeric',
                'label' => 'Database Port',
                'type' => 'number',
                'placeholder' => 'e.g: 3306',
            ],
            'DB_DATABASE' => [
                'rule' => 'required|string|max:50',
                'label' => 'Database Name',
                'type' => 'text',
                'placeholder' => 'e.g: web_installer'
            ],
            'DB_USERNAME' => [
                'rule' => 'required|string|max:50',
                'label' => 'Database Username',
                'type' => 'text',
                'placeholder' => 'e.g: root'
            ],
            'DB_PASSWORD' => [
                'rule' => 'required|string|max:50',
                'label' => 'Database Password',
                'type' => 'password',
                'placeholder' => 'e.g: **********'
            ],
        ],[
            'MAIL_MAILER' => [
                'rule' => 'required|string|max:50',
                'label' => 'Mail Driver',
                'type' => 'text',
                'placeholder' => 'e.g: smtp'
            ],
            'MAIL_HOST' => [
                'rule' => 'required|string|max:50',
                'label' => 'Mail Host',
                'type' => 'text',
                'placeholder' => 'e.g: smtp.gmail.com'
            ],
            'MAIL_PORT' => [
                'rule' => 'required|string|max:50',
                'label' => 'Mail Port',
                'type' => 'number',
                'placeholder' => 'e.g: 587'
            ],
            'MAIL_USERNAME' => [
                'rule' => 'required|string|max:50',
                'label' => 'Mail Username',
                'type' => 'text',
                'placeholder' => 'e.g: example@gmail.com'
            ],
            'MAIL_PASSWORD' => [
                'rule' => 'required|string|max:50',
                'label' => 'Mail Password',
                'type' => 'password',
                'placeholder' => 'e.g: **********'
            ],
            'MAIL_ENCRYPTION' => [
                'rule' => 'required|string|max:50',
                'label' => 'Mail Encryption',
                'type' => 'text',
                'placeholder' => 'e.g: TLS|SSL'
            ],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Mendetory items which you want to install
    |--------------------------------------------------------------------------
    */
    'need_to_know' => [
        'Codecanyon Purchase Code',

        'Database Name',
        'Database Username',
        'Database Password',
        'Database Hostname',
        'Database Port',

        'Mail Driver',
        'Mail Host',
        'Mail Port',
        'Mail Username',
        'Mail Password',
        'Mail Encryption'
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
    ],

    /*
    |--------------------------------------------------------------------------
    | Market place validation
    | set a verification code for active from market
    |--------------------------------------------------------------------------
    */
    'product' => '', //which product you verify same as supported server
    'verify_code' => '',
    'verify_purchase' => true,
    'verify_rules' => [
        'email' => [
            'rule' => 'required|string',
            'label' => 'Email',
            'type' => 'email',
            'placeholder' => 'e.g: example@email.com'
        ],
        'domain' => [
            'rule' => 'required|string',
            'label' => 'Domain Name',
            'type' => 'text',
            'placeholder' => 'e.g: https://example.com'
        ],
        'username' => [
            'rule' => 'required|string',
            'label' => 'Username',
            'type' => 'text',
            'placeholder' => 'e.g: example'
        ],
        'purchase_code' => [
            'rule' => 'required|string',
            'label' => 'Purchase Code',
            'type' => 'text',
            'placeholder' => 'e.g: 040afd3f-4cxa-4241-9e70-4gde9e4t674b'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Install commands
    | defind your installation commands
    |--------------------------------------------------------------------------
    */
    'install_commands' => [
        'composer update',
        'php migrate:fresh --force',
        'php artisan db:seed --force',
        'php storage:link --force'
    ],

    /*
    |--------------------------------------------------------------------------
    | Update commands
    | defind your update commands
    |--------------------------------------------------------------------------
    */
    'update_commands' => [
        'composer update'
    ],
];
