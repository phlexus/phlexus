<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

trait SaveAction {

    use Model;

    public function saveAction(): void {
        if (!$this->request->isPost()) {
            return;
        }
    }
}