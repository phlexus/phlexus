<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phalcon\Http\ResponseInterface;

trait SaveAction {

    use Model;

    use Form;

    public function saveAction(): ResponseInterface {
        if(!$this->request->isPost()) {
            return $this->response->redirect('user');
        }

        $model = $this->getModel();

        $form = $this->getForm();

        $fields = $this->getFields();

        $post = $this->request->getPost();
        
        $authorized = array_map(function($auth) { return $auth['name']; }, $fields);

        $form->bind(array_intersect_key($post, array_flip($authorized)), $model);
        
        # @TODO: Validate forms, csrf problem
        if($form->isValid() || true) {
            $model->save();

            $module = $this->dispatcher->getModuleName();
            $controller = $this->dispatcher->getControllerName();

            return $this->response->redirect(strtolower($module) . '/' . strtolower($controller));
        } else {
            return $this->response->redirect($this->request->getHttpReferer());
        }
    }
}