<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phlexus\Modules\BaseUser\Models\Profile;
use Phlexus\Libraries\Media\Models\Media;
use Phlexus\Libraries\Media\Models\MediaDestiny;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\Model as MvcModel;

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

        $isAdmin = Profile::getUserProfile()->isAdmin();

        $translationMessage = $this->translation->setPage()->setTypeMessage();

        // Check if user has edit permissions
        if (!$isAdmin) {
            $this->flash->error($translationMessage->_('no-save-permissions'));

            return $this->response->redirect($defaultRoute);
        }

        if ($key > 0) {
            $model = $model->findFirst([
                'conditions' => "$primaryKey = :$primaryKey:",
                'bind'       => [$primaryKey  => $key],
            ]);

            if (!$model) {
                $this->flash->error($translationMessage->_('record-not-found'));

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

            $model = $this->processUploadImage($model, $authorizedKeys);

            if (!$model || !$model->save()) {
                $this->flash->error($translationMessage->_('record-not-saved'));

                return $this->response->redirect($defaultRoute);
            }

            $this->flash->success($translationMessage->_('record-saved-sucessfully'));

            return $this->response->redirect($defaultRoute);
        } else {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message->getMessage());
            }

            return $this->response->redirect($this->request->getHttpReferer());
        }
    }

    /**
     * Process Upload Image
     *
     * @return MvcModel|false
     */
    private function processUploadImage(MvcModel $model, array $authorizedKeys) {
        if ($this->request->hasFiles() !== true) {
            return $model;
        }

        $files = $this->request->getUploadedFiles(true, true);

        foreach ($files as $key => $file) {
            if (!isset($authorizedKeys[$key])) {
                continue;
            }

            $handler = $this->media;        
            if (
                !$handler->setFile($file)
                         ->setFileDestiny(MediaDestiny::DESTINY_INTERNAL)
                         ->uploadFile()
            ) {
                return false;
            }

            $media = Media::createMedia(
                $handler->getUploadName(),
                $handler->getFileType(),
                $handler->getFileDestiny()
            );

            $handler->reset();

            if (!$media) {
               return false;
            }

            $model->{$key} = $media->id;

            return $model;
        }
    }
}