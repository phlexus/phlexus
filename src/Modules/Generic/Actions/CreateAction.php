<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

trait CreateAction {

    use Model;

    use Form;

    public function createAction(): void {
        $this->tag->setTitle('Create');

        $this->view->setVar('form', $this->getForm());

        $module = $this->dispatcher->getModuleName();
        $controller = $this->dispatcher->getControllerName();

        $saveRoute = strtolower($module) . '/' . strtolower($controller) . '/save';

        $this->view->setVar('saveRoute', $saveRoute);

        $this->view->pick('generic/create');
    }
}