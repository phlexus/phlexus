<?php declare(strict_types=1);

/**
 * Load composer dependencies
 */
$loader = require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Instantiate and load environment variables
 */
$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();

/**
 * Load Configurations
 */
$configs = require_once __DIR__ . '/../config/config.php';

/**
 * Instantiate Phlexus Application and run it!
 */
echo (new \Phlexus\Application('default', $configs, $loader->getPrefixesPsr4()))->run();
