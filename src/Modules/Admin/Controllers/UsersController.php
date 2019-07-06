<?php declare(strict_types=1);

namespace Phlexus\Modules\Admin\Controllers;

final class UsersController extends AbstractController
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
