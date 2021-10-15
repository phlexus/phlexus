<?php
declare(strict_types=1);

use Phalcon\Mvc\Router\Group as RouterGroup;

$routes = new RouterGroup([
    'module' => 'User',
    'controller' => 'UserController',
    'action' => 'index',
    'namespace' => 'Phlexus\Modules\User\Controllers',
]);

$routes->addGet('/user/users', [
    'controller' => 'user',
    'action' => 'view',
]);

foreach(['create', 'view'] as $action) {
    $routes->addGet('/user/users/' . $action, [
        'controller' => 'user',
        'action' => $action,
    ]);
}

$routes->addGet('/user/users/edit/{id:[0-9]+}', [
    'controller' => 'user',
    'action' => 'edit',
]);

$routes->addPost('/user/users/save', [
    'controller' => 'user',
    'action' => 'save',
]);

$routes->addPost('/user/users/delete/{id:[0-9]+}', [
    'controller' => 'user',
    'action' => 'delete',
]);

return $routes;