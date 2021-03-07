<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

trait EditAction {
    
    use Model;

    use Form;
    
    public function editAction(int $id) {
        $this->tag->setTitle('Edit');
        
        $model = $this->getModel();

        $form = $this->getForm();
        
        $record = $model->findFirstByid($id);

        $defaultRoute = $this->getBasePosition();

        if(!$record) {
            return $this->response->redirect($defaultRoute);
        }

        $form->setEntity($record);

        $saveRoute = $defaultRoute . '/save';

        $this->view->setVar('form', $this->getForm());

        $this->view->setVar('saveRoute', $saveRoute);

        $this->view->pick('generic/edit');
    }
}