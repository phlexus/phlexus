<?php
declare(strict_types=1);

use Phalcon\Mvc\Router\Group as RouterGroup;

$routes = new RouterGroup([
    'module' => 'User',
    'controller' => 'UsersController',
    'action' => 'index',
    'namespace' => 'Phlexus\Modules\User\Controllers',
]);

$routes->addGet('/user/users', [
    'controller' => 'users',
    'action' => 'index',
]);

foreach(['create', 'edit', 'view', 'save', 'delete'] as $action) {
    $routes->addGet('/user/users/' . $action, [
        'controller' => 'users',
        'action' => $action,
    ]);
}

return $routes;