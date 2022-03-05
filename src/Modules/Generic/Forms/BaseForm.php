<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Forms;

use Phlexus\Form\FormBase;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Mvc\Model\Resultset\Simple;
/**
 * Class BaseForm
 *
 * @package Phlexus\Modules\Generic\Forms
 */
class BaseForm extends FormBase
{
    private array $fields = [];

    /**
     * Set Fields
     * 
     * @param array $fields The form fields
     * 
     * @return void
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;

        $this->parseFields();
    }

    /**
     * Get Fields
     *
     * @return array The form fields
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Parse Fields
     *
     * @return void
     */
    private function parseFields(): void {
        $fields = $this->getFields();

        foreach ($fields as $field) {
            $type = isset($field['type']) ? $field['type'] : Text::class;

            $required = isset($field['required']) ? $field['required'] : false;

            $fieldName = $field['name'];

            if ($type === Select::class) {
                $selectOptions = isset($field['related']) ? $field['related'] : $field['values'];

                $parsedAttributes = $this->parseAttributes($field);

                $newField = new $type(
                    $fieldName,
                    $selectOptions,
                    $parsedAttributes
                );

                $selectKeys = $this->parseDataKeys($selectOptions, $parsedAttributes);

                $newField->addValidator(
                    new InclusionIn(
                        [
                            'message' => ucfirst($fieldName) . ' is required',
                            'domain' => $selectKeys
                        ]
                    )
                );
            } else {
                $newField = new $type(
                    $fieldName,
                    $this->parseAttributes($field)
                );
            }

            if ($required) {
                $newField->addValidator(new PresenceOf([
                    'message' => ucfirst($fieldName) . ' is required.',
                ]));
            }

            $this->add($newField);
        }
    }

    /**
     * Parse Fields
     *
     * @param array $attributes Attributes to parse
     * 
     * @return array Parsed attributes
     */
    private function parseAttributes(array $attributes): array {
        $ignoreAttributes = ['name', 'type', 'related'];

        return array_diff_key($attributes, array_flip($ignoreAttributes));
    }

    /**
     * Extract keys from data array
     *
     * @param mixed $data              Data array or object
     * @param array $parsedAttributes parsed attributes
     * 
     * @return array Parsed attributes
     */
    private function parseDataKeys($data, array $parsedAttributes = []): array {
        $keys = [];

        if (empty($data)) {
            return $keys;
        }

        if (is_object($data) && isset($parsedAttributes['using']) && $data instanceof Simple) {
            $keys = array_column($data->toArray(), $parsedAttributes['using'][0]);
        } elseif (is_array($data)) {
            $keys = array_keys($data);
        }

        return $keys;
    }
}
