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
    'action' => 'view',
]);

foreach(['create', 'view'] as $action) {
    $routes->addGet('/user/users/' . $action, [
        'controller' => 'users',
        'action' => $action,
    ]);
}

$routes->addGet('/user/users/edit/{id:[0-9]+}', [
    'controller' => 'users',
    'action' => 'edit',
]);

$routes->addPost('/user/users/save', [
    'controller' => 'users',
    'action' => 'save',
]);

$routes->addPost('/user/users/delete/{id:[0-9]+}', [
    'controller' => 'users',
    'action' => 'delete',
]);

return $routes;