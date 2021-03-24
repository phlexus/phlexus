<?php
declare(strict_types=1);

namespace Phlexus\Events\Listeners;

use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\DispatcherInterface;
use Phlexus\Libraries\Auth\AuthException;
use Phlexus\Helpers;

/**
 * Class AuthenticationListener
 *
 * @package Phlexus\Events\Listeners
 */
final class AuthenticationListener extends Injectable
{
    /**
     * This action is executed before execute any action in the application.
     *
     * @param Event $event Event object.
     * @param DispatcherInterface $dispatcher Dispatcher object.
     * @param array $data The event data.
     *
     * @return bool
     */
    public function beforeDispatchLoop(Event $event, DispatcherInterface $dispatcher, $data = null)
    {
        if (!$this->auth->isLogged() && !$this->isRouteExcluded()) {
            $this->getDI()->getShared('eventsManager')->fire(
                'dispatch:beforeException',
                $dispatcher,
                new AuthException('User is not authorized.')
            );
        }

        return !$event->isStopped();
    }

    /**
     * Check from config array if route is in exclude list
     *
     * Current verification is needed to prevent throwing exception
     * where it is not needed.
     *
     * @return bool
     */
    protected function isRouteExcluded(): bool
    {
        $router = $this->getDI()->getShared('router');
        $config = Helpers::phlexusConfig()->toArray();

        $excludeRoutes = $config['auth']['exclude_routes'] ?? [];
        $module = $router->getModuleName();
        $controller = $router->getControllerName();
        $action = $router->getActionName();

        // Check of module is in exclude array
        if (!isset($excludeRoutes[$module])) {
            return false;
        }

        // Check if module has '*'
        if (is_string($excludeRoutes[$module]) && $excludeRoutes[$module] === '*') {
            return true;
        }

        // Check if controller is in exclude array
        if (!isset($excludeRoutes[$module][$controller])) {
            return false;
        }

        // Check if modules controller has '*'
        if (is_string($excludeRoutes[$module][$controller]) && $excludeRoutes[$module][$controller] === '*') {
            return true;
        }

        // Check if action is in exclude array
        if (!in_array($action, $excludeRoutes[$module][$controller])) {
            return false;
        }

        return true;
    }
}
