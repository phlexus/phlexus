<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Action;

trait Edit {
    
    use Model;
    
    public function editAction(): void {
        $this->tag->setTitle('Edit');

        $this->view->pick('generic/edit');
    }
}