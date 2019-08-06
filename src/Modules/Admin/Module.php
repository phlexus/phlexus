<?php declare(strict_types=1);

namespace Phlexus\Modules\Admin;

use Phalcon\Di\DiInterface;
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
    }
}
