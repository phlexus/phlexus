<?php declare(strict_types=1);

namespace Phlexus\Modules\Landing;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phlexus\Module as PhlexusModel;

final class Module extends PhlexusModel
{
    public function getHandlersNamespace()
    {
        return 'Phlexus\Modules\Landing\Controllers';
    }

    /**
     * Registers an autoloader related to the module.
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $namespaces = [
            $this->getHandlersNamespace() => __DIR__ . '/controllers/',
        ];

        $loader = new Loader();
        $loader->registerNamespaces($namespaces);
        $loader->register();
    }

    /**
     * Registers services related to the module.
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di = null)
    {
        $view = $di->getShared('view');
        $view->setMainView(__DIR__ . '/../../themes/default/layouts/layout');
        $view->setViewsDir(__DIR__ . '/../../themes/default/landing/');
    }
}
