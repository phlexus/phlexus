<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::create(__DIR__);
$dotenv->load();

return
[
    'paths' => [
        'migrations' => [
            'Phlexus\\Migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations'
        ],
        'seeds' => [
            'Phlexus\\Seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds',
        ],
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'development',
        'development' => [
            'adapter' => strtolower(getenv('DB_ADAPTER')),
            'host' => getenv('DB_HOST'),
            'name' => strtolower(getenv('DB_ADAPTER')) === 'sqlite' ?
                '%%PHINX_CONFIG_DIR%%/db/' . getenv('DB_NAME') :
                getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASS'),
            'port' => getenv('DB_PORT'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ],
    'version_order' => 'creation'
];