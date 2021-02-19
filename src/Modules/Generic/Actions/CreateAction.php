<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

trait CreateAction {

    use Model;

    public function createAction(): void {
        $this->tag->setTitle('Create');

        $this->view->setVar('fields', $this->modelToFields());

        $this->view->pick('generic/create');
    }
}