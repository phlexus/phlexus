<?php
declare(strict_types=1);

namespace Phlexus\Modules\User\Controllers;

use Phlexus\Modules\BaseUser\Models\Users;
use Phlexus\Modules\BaseUser\Controllers\AbstractController;
use \Phlexus\Modules\Generic\Forms\BaseForm;

final class UsersController extends AbstractController
{
    use \Phlexus\Modules\Generic\Actions\CreateAction;
    use \Phlexus\Modules\Generic\Actions\EditAction;
    use \Phlexus\Modules\Generic\Actions\DeleteAction;
    use \Phlexus\Modules\Generic\Actions\ViewAction;
    use \Phlexus\Modules\Generic\Actions\SaveAction;

    public function initialize(): void
    {
        parent::initialize();

        $this->setModel(new Users);

        $form = new BaseForm();

        $this->setFields([
            [
                'name' => 'email',
                'type' => \Phalcon\Forms\Element\Email::class,
                'required' => true
            ],
            [
                'name' => 'password',
                'type' => \Phalcon\Forms\Element\Password::class,
                'required' => true
            ],
            [
                'name' => 'profileId',
                'type' => \Phalcon\Forms\Element\Select::class,
                'required' => true,
                'related' => \Phlexus\Modules\BaseUser\Models\Profiles::class,
                'using' => ['id', 'name']
            ]
        ]);

        $form->setFields($this->parseFields());

        $this->setForm($form);
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
