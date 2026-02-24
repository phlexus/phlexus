<?php

declare(strict_types=1);

use Phlexus\Application;

/**
 * Define root absolute path
 */
$rootPath = __DIR__;

define('ROOT_PATH', $rootPath);

/**
 * Load composer dependencies
 */
$loader = require_once $rootPath . '/vendor/autoload.php';

$installer = new Phlexus\Libraries\Theme\ThemeInstaller(
    'https://github.com/falcon758/phlexus-theme-admin-tabler/archive/refs/heads/master.zip',
    'phlexus-tabler-admin',
    'themes',
    'public/assets/themes'
);

$installer->install();