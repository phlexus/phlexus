<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Action;

trait View {

    use Model;
    
    public function viewAction(): void {
        $this->tag->setTitle('View');

        $this->view->pick('generic/view');
    }
}