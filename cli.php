<?php

/**
 * This file is part of the Phlexus CMS.
 *
 * (c) Phlexus CMS <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
echo (new Application($rootPath, Application::MODE_CLI, $configs, $loader->getPrefixesPsr4()))->runCLI($argv);
