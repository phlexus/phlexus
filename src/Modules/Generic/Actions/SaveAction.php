<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phalcon\Http\ResponseInterface;
use Phlexus\Modules\BaseUser\Models\Users;
use Phlexus\Modules\BaseUser\Models\Profiles;

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

        Profiles::getProfiles();

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
            $user = Users::getUser();
            $isAdmin = Profiles::getUserProfile()->isAdmin();

            if(!$isAdmin && (!isset($model->user_id) || $model->user_id !== $user->id)) {
                return $this->response->redirect($defaultRoute);
            }

            $model = $model->findFirst([
                'conditions' => "$primaryKey = :$primaryKey:",
                'bind'       => [$primaryKey  => $key],
            ]);

            if(!$model) {
                return $this->response->redirect($defaultRoute);
            }
        }
        
        $authorized = array_map(function($auth) { return $auth['name']; }, $fields);
        $authorizedKeys = array_flip($authorized);

        if(isset($authorizedKeys[$primaryKey])) {
            unset($authorizedKeys[$primaryKey]);
        }

        $form->bind(array_intersect_key($post, $authorizedKeys), $model);
        
        if($form->isValid()) {
            // Remove csrf content
            $model->csrf = null;

            $model->save();
            
            return $this->response->redirect($defaultRoute);
        } else {
            return $this->response->redirect($this->request->getHttpReferer());
        }
    }
}