<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phlexus\Modules\Generic\Forms\BaseForm;

trait Form {

    private BaseForm $form;

    private array $formFields = [];

    private function getForm(): BaseForm {
        return $this->form;
    }

    private function setForm(BaseForm $form) {
        $this->form = $form;
    }

    private function getFormFields(): array {
        return $this->formFields;
    }

    private function setFormFields(array $fields) {
        $this->formFields = $fields;
    }
}