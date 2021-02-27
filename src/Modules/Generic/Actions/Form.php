<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phlexus\Modules\Generic\Forms\BaseForm;

trait Form {

    private BaseForm $form;

    private array $fields = [];

    private function getForm(): BaseForm {
        return $this->form;
    }

    private function setForm(BaseForm $form) {
        $this->form = $form;
    }
}