<?php declare(strict_types=1);

use Phalcon\Mvc\Router\Group as RouterGroup;

$routes = new RouterGroup([
    'module' => 'Admin',
    'namespace' => 'Phlexus\Modules\Admin\Controllers',
]);

$routes->addGet('/admin/users', [
    'controller' => 'users',
    'action' => 'index',
]);

return $routes;
