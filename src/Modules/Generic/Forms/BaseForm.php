<?php

namespace Phlexus\Modules\Generic\Forms;

use Phlexus\Form\FormBase;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\File;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\File as ValidatorFile;

class BaseForm extends FormBase
{
    private array $fields = [];


    public function setFields(array $fields)
    {
        $this->fields = $fields;

        $this->parseFields();
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    private function parseFields(): void {
        $fields = $this->getFields();

        foreach($fields as $field) {
            $this->add(new Text($field->name, [
                'required' => true
            ]));
        }
    }
}
