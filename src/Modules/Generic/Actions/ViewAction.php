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
        ])->toArray();

        $fields = $this->getFields();
        $display = array_map(function($auth) { return $auth['name']; }, $fields);

        $this->view->setVar('display', $display);
        
        $this->view->setVar('records', $records);

        $this->view->pick('generic/view');
    }
}