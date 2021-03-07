<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phalcon\Http\ResponseInterface;

trait DeleteAction {
    
    use Model;

    public function deleteAction(int $id): void {
        $this->view->disable();

    }
}