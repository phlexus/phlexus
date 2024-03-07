<?php

declare(strict_types=1);

return [
    'company' => [
        'name'    => 'Phlexus',
        'address' => [
            'street'    => 'Street Address',
            'city'      => 'City',
            'post_code' => '11111'
        ],
        'email' => 'ltd@example'
    ],

    'application' => [
        'base_uri'   => '/',
        'upload_dir' => dirname(__DIR__) . '/public/assets/',
    ],

    'session' => [
        'session_name' => 'phlexus-app'
    ],

    'theme' => [
        'themes_dir'       => dirname(__DIR__) . '/themes/',
        'theme_user'       => 'phlexus-tabler-admin',
        'theme_public'     => '/assets/themes/',
    ],

    'paths' => [
        'themes' => dirname(__DIR__) . '/themes/',
        'models' => dirname(__DIR__) . '/src/Models/',
    ],

    'auth' => [
        'adapter' => 'model',
        'configurations' => [
            'model'  => \Phlexus\Modules\BaseUser\Models\User::class,
            'fields' => [
                'identity' => 'email',
                'password' => 'password',
                'id'       => 'id',
                'active'   => 'active',
            ],
            'login_redirect' => 'user',
        ],
        'exclude_routes' => [
            'Landing' => '*',
        ],
    ],

    'translations' => [
        'type'   => \Phlexus\Libraries\Translations\TranslationFactory::REDIS,
        'config' => [
            'files_dir' => dirname(__DIR__) .'/translations',
            'default_language' => 'en-us',
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
            '.phtml' => [
                'class' => \Phalcon\Mvc\View\Engine\Php::class
            ],
            '.volt'  => [
                'class'   => \Phalcon\Mvc\View\Engine\Volt::class,
                'options' => [
                    'path' => dirname(__DIR__). '/var/cache/',
                ],
            ],
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
