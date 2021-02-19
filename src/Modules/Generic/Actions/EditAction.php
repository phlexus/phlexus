<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

trait EditAction {
    
    use Model;
    
    public function editAction(): void {
        $this->tag->setTitle('Edit');

        $this->view->pick('generic/edit');
    }
}