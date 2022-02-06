<?php

declare(strict_types=1);

return [
    'application' => [
        'base_uri' => '/',
    ],

    'theme' => [
        'themes_dir' => __DIR__ . '/../themes/',
        'theme_user' => 'phlexus-tabler-admin',
        'theme_public' => '/assets/themes/',
        'themes_dir_cache' => __DIR__ . '/../var/cache/',
    ],

    'paths' => [
        'themes' => __DIR__ . '/../themes/',
        'models' => __DIR__ . '/../src/Models/',
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
        'type' => \Phlexus\Libraries\Translations\TranslationFactory::FILE,
        'config' => [
            'files_dir' => __DIR__ .'/../translations',
            'default_language' => 'en_US',
        ]
    ],

    'communications' => [
        'email' => [
            'config' => [
                'is_smtp' => true,
                'host' => '',
                'name' => 'Phlexus',
                'username' => '',
                'password' => '',
                'port' => '',
            ]
        ],

        // Not required
        'sms' => [
            'from'=> '',
            'config' => [
                'sid' => '',
                'token' => '',
            ]
        ],
    ],
    
    // Not required
    'payments' => [
        'paypal' => [
            'client_id'=> '',
            'client_secret' => ''
        ],
    ],

    'modules' => [
        'Landing' => [
            'className' => \Phlexus\Modules\Landing\Module::class,
            'path' => __DIR__ . '/../src/Modules/Landing/Module.php',
            'router' => __DIR__ . '/../src/Modules/Landing/Config/routes.php',
        ],
        'User' => [
            'className' => \Phlexus\Modules\User\Module::class,
            'path' => __DIR__ . '/../src/Modules/User/Module.php',
            'router' => __DIR__ . '/../src/Modules/User/Config/routes.php',
        ],
    ],

    'view' => [
        'engines' => [
            '.phtml' => \Phalcon\Mvc\View\Engine\Php::class,
        ]
    ],

    'db' => include_once 'database.php',

    'providers' => include_once 'providers.php',

    'security' => [
        'work_factor' => 14,

        'captcha' => [
            'config' => [
                'site-key'=> '',
                'secret' => '',
            ]
        ],
    ],

    'events' => [],
];
