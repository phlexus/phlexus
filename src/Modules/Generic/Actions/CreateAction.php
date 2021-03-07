<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

trait CreateAction {

    use Model;

    use Form;

    public function createAction(): void {
        $this->tag->setTitle('Create');
        
        $saveRoute = $this->getBasePosition() . '/save';

        $this->view->setVar('form', $this->getForm());

        $this->view->setVar('saveRoute', $saveRoute);

        $this->view->pick('generic/create');
    }
}