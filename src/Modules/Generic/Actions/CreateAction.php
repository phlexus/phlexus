<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

/**
 * Trait CreateAction
 *
 * @package Phlexus\Modules\Generic\Actions
 */
trait CreateAction {

    use \Phlexus\Modules\Generic\Model;

    use \Phlexus\Modules\Generic\Form;

    /**
     * Create Action
     *
     * @return void
     */
    public function createAction(): void {
        $this->tag->setTitle('Create');
        
        $saveRoute = $this->getBasePosition() . '/save';

        $defaultRoute = $this->getBasePosition();
        
        $this->view->setVar('form', $this->getForm());

        $this->view->setVar('defaultRoute', $defaultRoute);

        $this->view->setVar('saveRoute', $saveRoute);

        $this->view->pick('generic/create');
    }
}