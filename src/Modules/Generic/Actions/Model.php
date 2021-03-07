<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phalcon\Mvc\Model as MvcModel;

trait Model {

    private MvcModel $model;

    private array $viewFields = [];

    private function getModel(): MvcModel {
        return $this->model;
    }

    private function setModel(MvcModel $model) {
        $this->model = $model;
    }

    private function getViewFields(): array {
        return $this->viewFields;
    }

    private function setViewFields(array $fields) {
        $this->viewFields = $fields;
    }

    private function parseFields(array $fields): array {
        $model = $this->getModel();

        $reflection = new \ReflectionClass($model);

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