<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Action;

trait Create {

    use Model;

    public function createAction(): void {
        $this->tag->setTitle('Create');

        $this->view->pick('generic/create');
    }
}