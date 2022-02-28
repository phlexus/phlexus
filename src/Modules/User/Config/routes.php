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

foreach (['create', 'view'] as $action) {
    $routes->addGet('/user/' . $action, [
        'controller' => 'user',
        'action' => $action,
    ]);
}

$routes->addGet('/user/edit/{id:[0-9]+}', [
    'controller' => 'user',
    'action' => 'edit',
]);

$routes->addPost('/user/save', [
    'controller' => 'user',
    'action' => 'save',
]);

$routes->addPost('/user/delete/{id:[0-9]+}', [
    'controller' => 'user',
    'action' => 'delete',
]);

$routes->addGet('/profile', [
    'controller' => 'profile',
    'action' => 'edit',
]);

$routes->addPost('/profile/save', [
    'controller' => 'profile',
    'action' => 'save',
]);

return $routes;