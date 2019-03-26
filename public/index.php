<?php declare(strict_types=1);

$loader = require_once __DIR__ . '/../vendor/autoload.php';

use Phlexus\Application;

echo (new Application($loader->getPrefixesPsr4()))->run();
