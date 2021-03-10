<?php
declare(strict_types=1);

namespace Phlexus\Modules\Landing\Controllers;

use Phalcon\Mvc\Controller;

/**
 * Class Index
 *
 * @package Phlexus\Modules\Landing\Controllers
 */
final class IndexController extends Controller
{
    /**
     * Index Action
     *
     * @return void
     */
    public function indexAction(): void
    {
        $this->view->setVar('name', 'Phlexus CMS');
    }
}
