<?php
declare(strict_types=1);

namespace Phlexus\Events\Listeners;

use Phalcon\Events\Event;
use Phalcon\Mvc\DispatcherInterface;
use Phalcon\Plugin;
use Phlexus\Libraries\Auth\AuthException;

final class AuthorizationListener extends Plugin
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
        // TODO: ACL need to be validated here

        $this->getDI()->getShared('eventsManager')->fire(
            'dispatch:beforeException',
            $dispatcher,
            new AuthException('User is not authorized.')
        );

        $event->stop();

        return $event->isStopped();
    }
}
