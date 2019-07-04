<?php declare(strict_types=1);

namespace Phlexus\Modules\Admin;

use Phalcon\DiInterface;
use Phlexus\Modules\PhlexusAdmin\Module as PhlexusAdminModule;

/**
 * Class Module
 *
 * @package Phlexus\Modules\Admin
 */
class Module extends PhlexusAdminModule
{
    /**
     * @return string
     */
    public function getHandlersNamespace(): string
    {
        return 'Phlexus\Modules\Admin';
    }

    /**
     * @param DiInterface|null $di
     * @return void
     */
    public function registerServices(DiInterface $di = null)
    {
        parent::registerServices($di);

        $theme = $di->getShared('config')->get('theme');
        $themePath = $theme->themes_dir . $theme->theme_admin;
        $di->getShared('view')->setViewsDir($themePath . '/views/');
    }
}
