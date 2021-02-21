<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phalcon\Mvc\Model as MvcModel;

trait Model {

    private MvcModel $model;

    private array $fields = [];

    private function getModel(): MvcModel {
        return $this->model;
    }

    private function setModel(MvcModel $model) {
        $this->model = $model;
    }

    private function getFields(): array {
        return $this->fields;
    }

    private function setFields(array $fields) {
        $this->fields = $fields;
    }

    private function parseFields(): array {
        $model = $this->getModel();

        $reflection = new \ReflectionClass($model);

        $fields = $this->getFields();

        foreach($fields as $key => $field) {
            $fieldName = $field['name'];
            if(!$reflection->hasProperty($fieldName)) {
                unset($fields[$key]);
                continue;
            }

            if(isset($field['related'])) {
                $fields[$key]['related'] = ($field['related'])::find();
            }
        }

        return $fields;
    }
}