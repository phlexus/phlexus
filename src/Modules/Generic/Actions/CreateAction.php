<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phlexus\Modules\Generic\Forms\BaseForm;

trait CreateAction {

    use Model;

    public function createAction(): void {
        $this->tag->setTitle('Create');

        $form = new BaseForm();

        $form->setFields($this->modelToFields());

        $this->view->setVar('form', $form);

        $this->view->pick('generic/create');
    }
}