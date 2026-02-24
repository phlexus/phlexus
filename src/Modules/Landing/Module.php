<?php
declare(strict_types=1);

namespace Phlexus\Modules\Landing;

use Phalcon\Di\DiInterface;
use Phalcon\Autoload\Loader;
use Phalcon\Mvc\View\Engine\Volt;
use Phlexus\Module as PhlexusModel;
use Phlexus\Helpers;
use Phlexus\Events\Listeners\DispatcherListener;

final class Module extends PhlexusModel
{
    /**
     * Get Module Name
     * 
     * @return string
     */
    public static function getModuleName(): string
    {
        $namespaceParts = explode('\\', __NAMESPACE__);

        return end($namespaceParts);
    }

    /**
     * Get Handlers Namespace
     * 
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
        $loader->setNamespaces($namespaces);
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
        $theme = Helpers::phlexusConfig('theme');

        $themePath = $theme->themes_dir . $theme->theme_user;

        $view->setMainView($themePath . '/layouts/public');
        $view->setViewsDir($themePath . '/');

        $di->getShared('eventsManager')->attach('dispatch', new DispatcherListener());
    }
}
