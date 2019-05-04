<?php declare(strict_types=1);

return [
    'theme' => [
        'themes_dir' => __DIR__ . '/../themes/',
        'theme_admin' => 'phlexus-tabler-admin-theme',
        'themes_dir_cache' => __DIR__ . '/../cache/',
    ],
    'paths' => [
        'themes' => __DIR__ . '../themes/'
    ],
    'modules' => [
        'Landing' => [
            'className' => 'Phlexus\Modules\Landing\Module',
            'path' => __DIR__ . '/../modules/landing/Module.php',
            'router' => __DIR__ . '/../modules/landing/config/routes.php',
        ],
    ],
    'view' => [
        'engines' => [
            '.phtml' => 'Phalcon\Mvc\View\Engine\Php',
        ]
    ]
];
