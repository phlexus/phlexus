<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic;

use Phalcon\Mvc\Model as MvcModel;
use Phalcon\Mvc\Model\Resultset\Simple;

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

    private function getRelatedFields(): array {
        $model = $this->getModel();

        $relations = $model->getModelsManager()->getHasOne($model);

        $related = [];

        foreach($relations as $relation) {
            $field = $relation->getFields();
            $options = $relation->getOptions();

            $related[$field] = $options['alias'];
        }

        return $related;
    }

    private function translateRelatedFields(Simple $records): array {
        $related = $this->getRelatedFields();

        if(count($related) === 0) {
            return $records;
        }

        $fields = [];

        foreach($records as $key => $record) {
            $fields[$key] = [];

            foreach($related as $field => $table) {
                if(isset($record->{$table}->name)) {
                    $fields[$key][$field] = $record->{$table}->name;
                }
            }
        }

        return $fields;
    }
}