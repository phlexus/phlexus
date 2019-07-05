<?php declare(strict_types=1);

namespace Phlexus\Modules\Admin\Controllers;

use Phalcon\Mvc\Controller;

/**
 * Abstract Admin Controller
 *
 * @package Phlexus\Modules\Admin\Controllers
 */
abstract class AbstractController extends Controller
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        $theme = $this->getDI()->getShared('config')->get('theme');
        $themePath = $theme->themes_dir . $theme->theme_admin;

        $this->view->setMainView($themePath . '/views/layouts/default');
        $this->view->setViewsDir($themePath . '/views/');

        $this->tag->appendTitle(' - Phlexus Admin');
    }
}
