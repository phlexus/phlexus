<?php
declare(strict_types=1);

return [
    'adapter' => getenv('DB_ADAPTER'),
    'options' => [
        'host' => getenv('DB_HOST'),
        'dbname' => getenv('DB_NAME'),
        'port' => getenv('DB_PORT'),
        'username' => getenv('DB_USER'),
        'password' => getenv('DB_PASS'),
    ],
];
