<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phlexus\Libraries\Translations\TranslationAbstract;

/**
 * Trait ViewAction
 *
 * @package Phlexus\Modules\Generic\Actions
 */
trait ViewAction {

    use \Phlexus\Modules\Generic\Model;
    
    /**
     * View Action
     *
     * @return void
     */
    public function viewAction(): void {
        $this->tag->setTitle('View');

        $model = $this->getModel();

        $records = $model->find([
            'conditions' => 'active = :active:',
            'bind'       => ['active' => 1],
            'order'      => 'id DESC',
        ]);

        $defaultRoute = $this->getBasePosition();

        $this->view->setVar('display', $this->getViewFields());
        
        $this->view->setVar('records', array_replace_recursive(
            $records->toArray(), 
            $this->translateRelatedFields($records)
        ));

        $this->view->setVar('defaultRoute', $defaultRoute);

        $this->view->setVar('tType', $this->translation->getTranslatorType('generic', TranslationAbstract::PAGE));

        $this->view->setVar('csrfToken', $this->security->getToken());

        $this->view->pick('generic/view');
    }
}