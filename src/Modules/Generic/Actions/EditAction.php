<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phlexus\Modules\BaseUser\Models\Profile;
use Phalcon\Http\ResponseInterface;

/**
 * Trait EditAction
 *
 * @package Phlexus\Modules\Generic\Actions
 */
trait EditAction {
    
    use \Phlexus\Modules\Generic\Model;

    use \Phlexus\Modules\Generic\Form;
    
    /**
     * Edit Action
     * 
     * @param int $id The model id
     * 
     * @return mixed ResponseInterface or void
     */
    public function editAction(int $id) {
        $this->tag->setTitle('Edit');
        
        $model = $this->getModel();

        $isAdmin = Profile::getUserProfile()->isAdmin();

        $defaultRoute = $this->getBasePosition();

        $translationMessage = $this->translation->setPage()->setTypeMessage();

        // Check if user has edit permissions
        if (!$isAdmin) {
            $this->flash->error($translationMessage->_('no-edit-permissions'));

            return $this->response->redirect($defaultRoute);
        }

        $form = $this->getForm();
        
        $record = $model->findFirstByid($id);

        if (!$record) {
            $this->flash->error($translationMessage->_('record-not-found'));

            return $this->response->redirect($defaultRoute);
        }

        $form->setEntity($record);

        $saveRoute = $defaultRoute . '/save';

        $this->view->setVar('form', $this->getForm());

        $this->view->setVar('defaultRoute', $defaultRoute);
        
        $this->view->setVar('saveRoute', $saveRoute);

        $this->view->pick('generic/edit');
    }
}