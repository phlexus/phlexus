<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;
use Phlexus\Modules\BaseUser\Models\User;
use Phlexus\Modules\BaseUser\Models\Profile;

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
     * @return mixed Phalcon\Http\ResponseInterface or void
     */
    public function editAction(int $id) {
        $this->tag->setTitle('Edit');
        
        $model = $this->getModel();

        $user = User::getUser();
        $isAdmin = Profile::getUserProfile()->isAdmin();

        $defaultRoute = $this->getBasePosition();

        // Check if user has edit permissions
        if (!$isAdmin && (!isset($model->user_id) || $model->user_id !== $user->id)) {
            $this->flash->error('No permissions to edit!');

            return $this->response->redirect($defaultRoute);
        }

        $form = $this->getForm();
        
        $record = $model->findFirstByid($id);

        if (!$record) {
            $this->flash->error('Id not found!');

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