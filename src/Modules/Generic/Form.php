<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic;

use Phlexus\Modules\Generic\Forms\BaseForm;

/**
 * Trait Form
 *
 * @package Phlexus\Modules\Generic
 */
trait Form
{
    private BaseForm $form;

    private array $formFields = [];

    /**
     * Get Form
     *
     * @return BaseForm The BaseForm instance
     */
    private function getForm(): BaseForm
    {
        return $this->form;
    }

    /**
     * Set Form
     * 
     * @param BaseForm The BaseForm instance
     * 
     * @return void
     */
    private function setForm(BaseForm $form)
    {
        $this->form = $form;
    }

    /**
     * Get Form Fields
     *
     * @return array The Form Fields array
     */
    private function getFormFields(): array
    {
        return $this->formFields;
    }

    /**
     * Set Form Fields
     * 
     * @param array The Form Fields array
     * 
     * @return void
     */
    private function setFormFields(array $fields)
    {
        $this->formFields = $fields;
    }
}