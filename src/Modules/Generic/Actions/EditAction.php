<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phlexus\Modules\BaseUser\Models\Profile;
use Phalcon\Http\ResponseInterface;
use Phalcon\Tag;

/**
 * Trait EditAction
 *
 * @package Phlexus\Modules\Generic\Actions
 */
trait EditAction
{    
    use \Phlexus\Modules\Generic\Model;

    use \Phlexus\Modules\Generic\Form;
    
    /**
     * Edit Action
     * 
     * @param int $id The model id
     * 
     * @return mixed ResponseInterface or void
     */
    public function editAction(int $id)
    {
        $defaultTranslation = $this->translation->setPage();

        $isAdmin = Profile::getUserProfile()->isAdmin();

        $defaultRoute = $this->getBasePosition();

        // Check if user has edit permissions
        if (!$isAdmin) {
            $this->flash->error($defaultTranslation->setTypeMessage()->_('no-edit-permissions'));

            return $this->response->redirect($defaultRoute);
        }

        $title = $defaultTranslation->setTypePage()->_('title-generic-edit');

        Tag::appendTitle($title);
        
        $model = $this->getModel();

        $form = $this->getForm();
        
        $record = $model->findFirstByid($id);

        if (!$record) {
            $this->flash->error($defaultTranslation->setTypeMessage()->_('record-not-found'));

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