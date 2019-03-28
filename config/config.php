<?php declare(strict_types=1);

return [
    'theme' => 'default',
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
