<?php

/**
 * This file is part of the Phlexus CMS.
 *
 * (c) Phlexus CMS <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=0);

use Phlexus\Application;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Define root absolute path
 */
$rootPath = dirname(__DIR__);

define('ROOT_PATH', $rootPath);

/**
 * Load composer dependencies
 */
$loader = require_once $rootPath . '/vendor/autoload.php';

/**
 * Instantiate and load environment variables
 */
Dotenv\Dotenv::create($rootPath)->load();

/**
 * Load Configurations
 */
$configs = require_once $rootPath . '/config/config.php';

/**
 * Instantiate Phlexus Application and run it!
 */
echo (new Application($rootPath, Application::MODE_DEFAULT, $configs, $loader->getPrefixesPsr4()))->run();
