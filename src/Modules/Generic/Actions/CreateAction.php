<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phlexus\Libraries\Translations\TranslationAbstract;

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
        
        $defaultRoute = $this->getBasePosition();

        $saveRoute =  $defaultRoute . '/save';

        $this->view->setVar('form', $this->getForm());

        $this->view->setVar('defaultRoute', $defaultRoute);

        $this->view->setVar('saveRoute', $saveRoute);

        $this->view->setVar('tType', $this->translation->getTranslatorType('generic', TranslationAbstract::PAGE));

        $this->view->pick('generic/create');
    }
}