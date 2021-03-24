<?php
declare(strict_types=1);

namespace Phlexus\Modules\Landing;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phlexus\Module as PhlexusModel;

final class Module extends PhlexusModel
{
    /**
     * @return string
     */
    public static function getModuleName(): string
    {
        $namespaceParts = explode('\\', __NAMESPACE__);

        return end($namespaceParts);
    }

    /**
     * @return string
     */
    public static function getHandlersNamespace(): string
    {
        return __NAMESPACE__;
    }

    /**
     * Registers an autoloader related to the module.
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null): void
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
    public function registerServices(DiInterface $di = null): void
    {
        $view = $di->getShared('view');
        $view->setMainView(__DIR__ . '/../../../themes/default/layouts/layout');
        $view->setViewsDir(__DIR__ . '/../../../themes/default/landing/');
    }
}
