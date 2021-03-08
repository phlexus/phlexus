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
        ]);

        $this->view->setVar('display', $this->getViewFields());
        
        $this->view->setVar('records', array_replace_recursive(
            $records->toArray(), 
            $this->translateRelatedFields($records)
        ));

        $this->view->pick('generic/view');
    }
}