<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phalcon\Http\ResponseInterface;

trait SaveAction {

    use Model;

    use Form;

    private string $primaryKey = 'id';

    public function saveAction(): ResponseInterface {
        $this->view->disable();

        $defaultRoute = $this->getBasePosition();

        if(!$this->request->isPost()) {
            return $this->response->redirect($defaultRoute);
        }

        $form = $this->getForm();

        $fields = $this->getFormFields();

        $post = $this->request->getPost();

        $primaryKey = $this->primaryKey;
        $key = (int) (isset($post[$primaryKey]) ? $post[$primaryKey] : null);

        $model = $this->getModel();

        if($key > 0) {
            $model = $model->findFirst([
                'conditions' => "$primaryKey = :$primaryKey:",
                'bind'       => [$primaryKey  => $key],
            ]);

            if(!$model) {
                return $this->response->redirect($defaultRoute);
            }
        }
        
        $authorized = array_map(function($auth) { return $auth['name']; }, $fields);

        if(isset($authorized[$primaryKey])) {
            unset($authorized[$primaryKey]);
        }

        $form->bind(array_intersect_key($post, array_flip($authorized)), $model);
        
        # @TODO: Validate forms, csrf problem
        if($form->isValid() || true) {
            $model->save();

            return $this->response->redirect($defaultRoute);
        } else {
            return $this->response->redirect($this->request->getHttpReferer());
        }
    }
}