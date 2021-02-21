<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phlexus\Modules\Generic\Forms\BaseForm;

trait CreateAction {

    use Model;

    public function createAction(): void {
        $this->tag->setTitle('Create');

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

        $this->view->setVar('form', $form);

        $this->view->pick('generic/create');
    }
}