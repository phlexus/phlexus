<?php
declare(strict_types=1);

namespace Phlexus\Modules\User\Controllers;

use Phlexus\Modules\BaseUser\Models\Users;
use Phlexus\Modules\BaseUser\Controllers\AbstractController;

final class UsersController extends AbstractController
{
    use \Phlexus\Modules\Generic\Action\Create;
    use \Phlexus\Modules\Generic\Action\Edit;
    use \Phlexus\Modules\Generic\Action\Delete;
    use \Phlexus\Modules\Generic\Action\View;

    public function initialize(): void
    {
        parent::initialize();

        $this->setModel(new Users);
    }

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
