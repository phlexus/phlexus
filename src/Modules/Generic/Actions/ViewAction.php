<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

trait ViewAction {

    use Model;
    
    public function viewAction(): void {
        $this->tag->setTitle('View');

        $this->view->pick('generic/view');
    }
}