<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

trait ViewAction {

    use Model;
    
    public function viewAction(): void {
        $this->tag->setTitle('View');

        $model = $this->getModel();

        $records = $model->find([
            'conditions' => 'active = :active:',
            'bind'       => ['active' => 1],
            'order'      => 'id DESC',
        ])->toArray();
        
        $this->view->setVar('display', $this->getViewFields());
        
        $this->view->setVar('records', $records);

        $this->view->pick('generic/view');
    }
}