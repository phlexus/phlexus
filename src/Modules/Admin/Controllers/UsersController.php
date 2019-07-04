<?php declare(strict_types=1);

namespace Phlexus\Modules\Admin\Controllers;

use Phalcon\Mvc\Controller;

final class UsersController extends Controller
{
    /**
     * Users list
     *
     * @return void
     */
    public function indexAction(): void
    {
        $this->tag->setTitle('Users');
    }
}
