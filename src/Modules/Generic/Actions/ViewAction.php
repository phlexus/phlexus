<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

trait ViewAction {

    use Model;
    
    public function viewAction(): void {
        $this->tag->setTitle('View');

        $model = $this->getModel();

        $records = $model->find([
            'order' => 'id DESC',
        ]);

        $this->view->setVar('records', $records);

        $this->view->pick('generic/view');
    }
}