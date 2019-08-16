<?php declare(strict_types=1);

/**
 * Load composer dependencies
 */
$loader = require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Instantiate and load environment variables
 */
Dotenv\Dotenv::create(__DIR__ . '/../')->load();

/**
 * Load Configurations
 */
$configs = require_once __DIR__ . '/../config/config.php';

/**
 * Instantiate Phlexus Application and run it!
 */
echo (new \Phlexus\Application(\Phlexus\Application::MODE_DEFAULT, $configs, $loader->getPrefixesPsr4()))->run();
