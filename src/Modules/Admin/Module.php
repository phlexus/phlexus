<?php
declare(strict_types=1);

namespace Phlexus\Modules\Admin;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phlexus\Modules\BaseAdmin\Module as BaseAdminModule;

/**
 * Class Module
 *
 * @package Phlexus\Modules\Admin
 */
class Module extends BaseAdminModule
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
     * @return void
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $namespaces = [
            self::getHandlersNamespace() . '\\Controllers' => __DIR__ . '/Controllers/',
        ];

        $loader = new Loader();
        $loader->registerNamespaces($namespaces);
        $loader->register();
    }

    /**
     * @param DiInterface|null $di
     * @return void
     */
    public function registerServices(DiInterface $di = null)
    {
        parent::registerServices($di);

        $themePath = phlexus_themes_path() . phlexus_config('theme.theme_admin');
        $view = $di->getShared('view');
        $view->setMainView($themePath . '/layouts/default');
        $view->setViewsDir($themePath . '/');
    }
}
