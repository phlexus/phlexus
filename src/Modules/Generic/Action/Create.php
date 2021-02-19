<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Action;

trait Create {

    use Model;

    public function createAction(): bool {
        if ($this->request->isPost()) {
            return $this->response->redirect('user/auth');
        }
    }
}