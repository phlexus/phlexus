<?php
declare(strict_types=1);

use Phalcon\Mvc\Router\Group as RouterGroup;

$routes = new RouterGroup([
    'module' => 'Landing',
    'controller' => 'IndexController',
    'action' => 'index',
    'namespace' => 'Phlexus\Modules\Landing\Controllers',
]);

$routes->addGet('/', [
    'controller' => 1,
    'action' => 2,
]);

return $routes;
