<?php

use Phalcon\Config\Config;
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
            'settings',
            'address_type',
            'countries',
            'language',
            'pages',
            'text_type',
            'translation_keys',
            'translations',
            'media_type',
            'media_destiny',
            'order_status',
            'payment_status',
            'payment_type',
            'payment_method',
            'shipping_method',
            'profiles',
            'resources',
            'profile_resources',
            'users',
        ],
    ],
]);