<?php

declare(strict_types=1);

return [
    'application' => [
        'base_uri' => '/',
        'upload_dir' => dirname(__DIR__) . '/public/assets/',
    ],

    'theme' => [
        'themes_dir'       => dirname(__DIR__) . '/themes/',
        'theme_user'       => 'phlexus-tabler-admin',
        'theme_public'     => '/assets/themes/',
        'themes_dir_cache' => dirname(__DIR__). '/var/cache/',
    ],

    'paths' => [
        'themes' => dirname(__DIR__) . '/themes/',
        'models' => dirname(__DIR__) . '/src/Models/',
    ],

    'auth' => [
        'adapter' => 'model',
        'configurations' => [
            'model' => \Phlexus\Modules\BaseUser\Models\User::class,
            'fields' => [
                'identity' => 'email',
                'password' => 'password',
                'id' => 'id',
            ],
        ],
        'exclude_routes' => [
            'Landing' => '*',
        ],
    ],

    'translations' => [
        'type'   => \Phlexus\Libraries\Translations\TranslationFactory::REDIS,
        'config' => [
            'files_dir' => dirname(__DIR__) .'/translations',
            'default_language' => 'en_US',
        ],
    ],

    'communications' => [
        'email' => [
            'config' => [
                'is_smtp'  => true,
                'host'     => '',
                'name'     => '',
                'username' => '',
                'password' => '',
                'port'     => '',
            ],
        ],

        'sms' => [
            'from'=> '',
            'config' => [
                'sid'   => '',
                'token' => '',
            ]
        ],
    ],
    
    // Not required
    'payments' => [
        'paypal' => [
            'client_id'     => '',
            'client_secret' => ''
        ],
    ],

    'modules' => [
        'Landing' => [
            'className' => \Phlexus\Modules\Landing\Module::class,
            'path'      => dirname(__DIR__) . '/src/Modules/Landing/Module.php',
            'router'    => dirname(__DIR__) . '/src/Modules/Landing/Config/routes.php',
        ],
    ],

    'view' => [
        'engines' => [
            '.phtml' => \Phalcon\Mvc\View\Engine\Php::class,
        ],
    ],

    'db' => include_once 'database.php',

    'providers' => include_once 'providers.php',

    'security' => [
        'app_hash' => 'A_STRONG_HASH',

        'work_factor' => 14,
        
        'captcha' => [
            'config' => [
                'site-key'=> '',
                'secret'  => '',
            ],
        ],
    ],

    'cache' => [
        'redis' => [
            'config' => [
                'defaultSerializer' => 'Json',
                'lifetime'          => 7200,
                'host'              => 'localhost',
                'port'              => 6379,
                'index'             => 1,
            ],
        ],
    ],

    'events' => [],
];
