<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

trait SaveAction {

    use Model;

    use Form;

    public function saveAction(): void {
        if(!$this->request->isPost()) {
            return;
        }

        $model = $this->getModel();

        $form = $this->getForm();

        $fields = $this->getFields();

        $post = $this->request->getPost();
        
        $authorized = array_map(function($auth) { return $auth['name']; }, $fields);

        $form->bind(array_intersect_key($post, array_flip($authorized)), $model);
        
        if($form->isValid()) {
            exit('valid');
        }

        var_dump($form->getMessages());

        exit('teste');
    }
}