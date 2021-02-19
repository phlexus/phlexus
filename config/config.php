<?php

declare(strict_types=1);

return [
    'application' => [
        'base_uri' => '/',
    ],
    'theme' => [
        'themes_dir' => __DIR__ . '/../themes/',
        'theme_user' => 'phlexus-tabler-admin',
        'themes_dir_cache' => __DIR__ . '/../var/cache/',
    ],
    'paths' => [
        'themes' => __DIR__ . '/../themes/',
        'models' => __DIR__ . '/../src/Models/',
    ],
    'auth' => [
        'adapter' => 'model',
        'configurations' => [
            'model' => \Phlexus\Modules\BaseUser\Models\Users::class,
            'fields' => [
                'identity' => 'email',
                'password' => 'password',
                'id' => 'id',
            ],
        ],
        'exclude_routes' => [
            'Landing' => '*',
            // TODO: move outside to phlexus-module-users
            \Phlexus\Modules\BaseUser\Module::getModuleName() => [
                'auth' => ['login', 'doLogin', 'logout'],
            ],
        ],
    ],
    'modules' => [
        'Landing' => [
            'className' => 'Phlexus\Modules\Landing\Module',
            'path' => __DIR__ . '/../src/Modules/Landing/Module.php',
            'router' => __DIR__ . '/../src/Modules/Landing/Config/routes.php',
        ],
        'User' => [
            'className' => 'Phlexus\Modules\User\Module',
            'path' => __DIR__ . '/../src/Modules/User/Module.php',
            'router' => __DIR__ . '/../src/Modules/User/Config/routes.php',
        ],
    ],
    'view' => [
        'engines' => [
            '.phtml' => 'Phalcon\Mvc\View\Engine\Php',
        ]
    ],
    'db' => include_once 'database.php',
    'providers' => include_once 'providers.php',
    'security' => [
        'work_factor' => 14,
    ],
    'events' => [],
];
