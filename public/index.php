<?php declare(strict_types=1);

$loader = require_once __DIR__ . '/../vendor/autoload.php';
$configs = require_once __DIR__ . '/../config/config.php';

echo (new \Phlexus\Application('default', $configs, $loader->getPrefixesPsr4()))->run();
