<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phlexus\Modules\BaseUser\Models\Profile;
use Phalcon\Http\ResponseInterface;

/**
 * Trait ViewAction
 *
 * @package Phlexus\Modules\Generic\Actions
 */
trait ViewAction
{
    use \Phlexus\Modules\Generic\Model;
    
    /**
     * View Action
     *
     * @return mixed ResponseInterface or void
     */
    public function viewAction()
    {
        $defaultTranslation = $this->translation->setPage();

        $title = $defaultTranslation->setTypePage()->_('title-generic-view');

        $this->tag->appendTitle($title);

        $model = $this->getModel();

        $records = $model->find([
            'conditions' => 'active = :active:',
            'bind'       => ['active' => 1],
            'order'      => 'id DESC',
        ]);

        $defaultRoute = $this->getBasePosition();

        $isAdmin = Profile::getUserProfile()->isAdmin();

        // Check if user has view permissions
        if (!$isAdmin) {
            $this->flash->error($defaultTranslation->setTypeMessage()->_('no-view-permissions'));

            return $this->response->redirect($defaultRoute);
        }

        $this->view->setVar('display', $this->getViewFields());

        $this->view->setVar('records', array_replace_recursive(
            $records->toArray(), 
            $this->translateRelatedFields($records)
        ));

        $this->view->setVar('defaultRoute', $defaultRoute);

        $this->view->setVar('csrfToken', $this->security->getToken());

        $this->view->pick('generic/view');
    }
}