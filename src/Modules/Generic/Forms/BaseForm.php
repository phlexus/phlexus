<?php

namespace Phlexus\Modules\Generic\Forms;

use Phlexus\Form\FormBase;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;

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
            $type = isset($field['type']) ? $field['type'] : Text::class;

            $required = isset($field['required']) ? $field['required'] : false;

            $fieldName = $field['name'];

            if($type === Select::class) {
                $new_field = new $type(
                    $fieldName,
                    isset($field['related']) ? $field['related'] : $field['values'],
                    $this->parseAttributes($field)
                );
            } else {
                $new_field = new $type(
                    $fieldName,
                    $this->parseAttributes($field)
                );
            }

            if($required) {
                $new_field->addValidator(new PresenceOf([
                    'message' => ucfirst($fieldName) . ' is required.',
                ]));
            }

            $this->add($new_field);
        }
    }

    private function parseAttributes(array $attributes): array {
        $ignoreAttributes = ['name', 'type', 'related'];

        return array_diff_key($attributes, array_flip($ignoreAttributes));
    }
}
