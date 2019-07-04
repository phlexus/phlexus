<?php declare(strict_types=1);

namespace Phlexus\Events\Listeners;

use Exception;
use Phalcon\Di\Exception as DiException;
use Phalcon\Plugin;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phlexus\Libraries\Auth\AuthException;
use Phlexus\Module\ModuleException;
use Phlexus\Module\ModuleInterface;
use Phalcon\Mvc\Dispatcher\Exception as MvcDispatcherException;

final class DispatcherListener extends Plugin
{
    /**
     * Before forwarding is happening.
     *
     * @param Event $event Event object.
     * @param Dispatcher $dispatcher Dispatcher object.
     * @param array $forward The forward data.
     *
     * @return bool
     * @throws DiException
     * @throws Exception
     */
    public function beforeForward(Event $event, Dispatcher $dispatcher, array $forward = []): bool
    {
        if (!empty($forward['module'])) {
            if (!phlexus_container('modules')->offsetExists($forward['module'])) {
                throw new ModuleException("Module {$forward['module']} does not exist.");
            }

            $moduleDefinition = phlexus_container('modules')->offsetGet($forward['module']);

            // TODO: think about that validation, as there are atm only vendor DI declaration
            /*if (!phlexus_container()->has($moduleDefinition->className)) {
                throw new DiException(
                    "Service '{$moduleDefinition->className}' wasn't found in the dependency injection container"
                );
            }*/

            /** @var ModuleInterface $module */
            $module = phlexus_container($moduleDefinition->className);
            $dispatcher->setModuleName($forward['module']);
            $dispatcher->setNamespaceName($module->getHandlersNamespace());
        }

        return $event->isStopped();
    }

    /**
     * Before exception is happening.
     *
     * @param Event $event Event object.
     * @param Dispatcher $dispatcher Dispatcher object.
     * @param \Exception $exception Exception object.
     *
     * @throws \Exception
     * @return bool
     */
    public function beforeException(Event $event, Dispatcher $dispatcher, Exception $exception): bool
    {
        if ($exception instanceof MvcDispatcherException) {
            $this->response->setStatusCode(404);
            $dispatcher->forward([
                'module' => 'Admin',
                'namespace' => 'Phlexus\Modules\Admin\Controllers',
                'controller' => 'errors',
                'action' => 'show404',
            ]);

            $event->stop();
        }

        if ($exception instanceof AuthException) {
            $this->response->setStatusCode(402);
            $dispatcher->forward([
                'module' => 'phlexusadmin',
                'namespace' => 'Phlexus\Modules\PhlexusAdmin\Controllers',
                'controller' => 'auth',
                'action' => 'login',
            ]);

            $event->stop();
        }

        return $event->isStopped();
    }
}
