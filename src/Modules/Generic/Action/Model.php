<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Action;

use Phalcon\Mvc\Model as MvcModel;

trait Model {

    private MvcModel $model;

    private array $allowedFields = [];

    private function getModel(): MvcModel {
        return $this->model;
    }

    private function setModel(MvcModel $model) {
        $this->model = $model;
    }

    private function getAllowedFields(): array {
        return $this->allowedFields;
    }

    private function setAllowedFields(array $allowedFields) {
        $this->allowedFields = $allowedFields;
    }
}