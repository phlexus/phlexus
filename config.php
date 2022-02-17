<?php

use Phalcon\Config;
use Dotenv\Dotenv;

$dotenv = Dotenv::create(__DIR__);
$dotenv->load();

return new Config([
    'database' => [
        'adapter' => getenv('DB_ADAPTER'),
        'host' => getenv('DB_HOST'),
        'dbname' => getenv('DB_NAME'),
        'port' => getenv('DB_PORT'),
        'username' => getenv('DB_USER'),
        'password' => getenv('DB_PASS'),
    ],
    'application' => [
        'logInDb' => true,
        'migrationsDir' => 'db/migrations',
        'migrationsTsBased' => false,
        'exportDataFromTables' => [
            'address_type',
            'countries',
            'language',
            'pages',
            'text_type',
            'translations',
            'payment_method',
            'shipping_method',
            'profiles',
            'permissions',
            'users',
        ],
    ],
]);