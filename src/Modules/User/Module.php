<?php
declare(strict_types=1);

namespace Phlexus\Modules\User;

use Phalcon\Di\DiInterface;
use Phalcon\Loader;
use Phlexus\Modules\BaseUser\Module as BaseUserModule;
use Phlexus\Helpers;

/**
 * Class Module
 *
 * @package Phlexus\Modules\User
 */
class Module extends BaseUserModule
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

        $themePath = Helpers::phlexusThemesPath() . Helpers::phlexusConfig('theme.theme_user');
        $view = $di->getShared('view');

        $view->setViewsDir($themePath . '/');
    }
}
