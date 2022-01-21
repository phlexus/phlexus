<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phalcon\Http\ResponseInterface;
use Phlexus\Modules\BaseUser\Models\User;
use Phlexus\Modules\BaseUser\Models\Profile;

/**
 * Trait SaveAction
 *
 * @package Phlexus\Modules\Generic\Actions
 */
trait SaveAction {

    use \Phlexus\Modules\Generic\Model;

    use \Phlexus\Modules\Generic\Form;

    private string $primaryKey = 'id';

    /**
     * Save Action
     *
     * @return ResponseInterface
     */
    public function saveAction(): ResponseInterface {
        $this->view->disable();

        $isEdit = false;

        $defaultRoute = $this->getBasePosition();

        if (!$this->request->isPost() 
            || !$this->security->checkToken('csrf', $this->request->getPost('csrf', null))) {
            return $this->response->redirect($defaultRoute);
        }

        $form = $this->getForm();

        $fields = $this->getFormFields();

        $post = $this->request->getPost();

        $primaryKey = $this->primaryKey;
        $key = (int) (isset($post[$primaryKey]) ? $post[$primaryKey] : 0);

        $model = $this->getModel();

        if ($key > 0) {
            $user = User::getUser();
            $isAdmin = Profile::getUserProfile()->isAdmin();

            // Check if user has edit permissions
            if (!$isAdmin && (!isset($model->user_id) || $model->user_id !== $user->id)) {
                return $this->response->redirect($defaultRoute);
            }

            $model = $model->findFirst([
                'conditions' => "$primaryKey = :$primaryKey:",
                'bind'       => [$primaryKey  => $key],
            ]);

            if (!$model) {
                return $this->response->redirect($defaultRoute);
            }

            $isEdit = true;
        }
        
        $authorized = array_map(function($auth) { return $auth['name']; }, $fields);
        $authorizedKeys = array_flip($authorized);

        // Remove primary key for beeing edited
        if (isset($authorizedKeys[$primaryKey])) {
            unset($authorizedKeys[$primaryKey]);
        }

        $form->bind(array_intersect_key($post, $authorizedKeys), $model);
        
        if ($form->isValid()) {
            // Remove csrf content
            $model->csrf = null;

            $ts = date('Y-m-d H:i:s', time());

            if (!$isEdit) {
                $model->createdAt = $ts;
            }

            $model->modifiedAt = $ts;

            $model->save();
            
            return $this->response->redirect($defaultRoute);
        } else {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message->getMessage());
            }

            return $this->response->redirect($this->request->getHttpReferer());
        }
    }
}