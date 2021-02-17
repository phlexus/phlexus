<?php
declare(strict_types=1);

namespace Phlexus\Modules\Admin\Controllers;

use Phlexus\Modules\BaseUser\Models\Users;
use Phlexus\Modules\BaseAdmin\Controllers\AbstractController;

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

        $users = Users::find([
            'order' => 'id DESC',
        ]);

        $this->view->setVar('users', $users);
    }
}
