<?php declare(strict_types=1);

namespace Phlexus\Modules\Admin\Controllers;

/**
 * Class IndexController
 *
 * @package Phlexus\Modules\Admin\Controllers
 */
final class IndexController extends AbstractController
{
    /**
     * @return void
     */
    public function indexAction(): void
    {
        $this->tag->setTitle('Dashboard');
    }
}
