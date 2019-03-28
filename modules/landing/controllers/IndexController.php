<?php declare(strict_types=1);

namespace Phlexus\Modules\Landing\Controllers;

use Phalcon\Mvc\Controller;

final class IndexController extends Controller
{
    public function indexAction(): void
    {
        $this->view->setVar('name', 'Phlexus CMS');
    }
}
