<?php
declare(strict_types=1);

use Phalcon\Mvc\Router\Group as RouterGroup;

$routes = new RouterGroup([
    'module' => 'Landing',
    'controller' => 'HomeController',
    'action' => 'index',
    'namespace' => 'Phlexus\Modules\Landing\Controllers',
]);

$routes->addGet('/home', [
    'controller' => 'home',
    'action' => 'index',
]);

return $routes;
