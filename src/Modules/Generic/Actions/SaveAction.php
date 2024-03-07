<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phlexus\Modules\BaseUser\Models\Profile;
use Phlexus\Libraries\Media\Models\Media;
use Phlexus\Libraries\Media\Models\MediaDestiny;
use Phlexus\Libraries\Media\Files\MimeTypes;
use Phlexus\Models\Model as MvcModel;
use Phalcon\Http\ResponseInterface;
use Exception;

/**
 * Trait SaveAction
 *
 * @package Phlexus\Modules\Generic\Actions
 */
trait SaveAction
{
    use \Phlexus\Modules\Generic\Model;

    use \Phlexus\Modules\Generic\Form;

    private string $primaryKey = 'id';

    /**
     * Save Action
     *
     * @return ResponseInterface
     */
    public function saveAction(): ResponseInterface
    {
        $this->view->disable();

        $translationMessage = $this->translation->setPage()->setTypeMessage();

        $defaultRoute = $this->getBasePosition();

        $isAdmin = Profile::getUserProfile()->isAdmin();

        // Check if user has edit permissions
        if (!$isAdmin) {
            $this->flash->error($translationMessage->_('no-save-permissions'));

            return $this->response->redirect($defaultRoute);
        }

        if (!$this->request->isPost() 
            || !$this->security->checkToken('csrf', (string) $this->request->getPost('csrf'))) {
            return $this->response->redirect($defaultRoute);
        }

        $isEdit = false;

        $primaryKey = $this->primaryKey;

        $model = $this->getModel();

        $key = $this->getModelKey();

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

        $fields = $this->getFormFields();

        $authorized = array_map(function($auth) { return $auth['name']; }, $fields);
        $authorizedKeys = array_flip($authorized);

        // Remove primary key for beeing edited
        if (isset($authorizedKeys[$primaryKey])) {
            unset($authorizedKeys[$primaryKey]);
        }

        $form = $this->getForm();

        $post = $this->request->getPost();

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

            // Set model with saved data
            $this->setModel($model);

            $this->flash->success($translationMessage->_('record-saved-sucessfully'));

            return $this->response->redirect($defaultRoute);
        } else {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message->getMessage());
            }

            // @ToDo: Change to a url helper
            $refererURL = $this->request->getHttpReferer();
            $parsedUrl  = parse_url($refererURL);

            return $this->response->redirect($parsedUrl['path'] ?? '/');
        }
    }

    /**
     * Is model editting
     *
     * @return bool
     */
    private function isModelEdit(): bool
    {
        return $this->getModelKey() > 0;
    }

    /**
     * Get model key
     *
     * @return int
     */
    private function getModelKey(): int
    {
        return (int) $this->request->getPost($this->primaryKey, null, 0);
    }

    /**
     * Process Upload Image
     *
     * @return MvcModel|false
     */
    private function processUploadImage(MvcModel $model, array $authorizedKeys)
    {
        if ($this->request->hasFiles() !== true) {
            return $model;
        }

        $files = $this->request->getUploadedFiles(true, true);

        foreach ($files as $key => $file) {
            if (!isset($authorizedKeys[$key])) {
                continue;
            }

            $uploader = $this->uploader;        
            
            try {
                $media = $uploader->setFile($file)
                        ->setAllowedMimeTypes(MimeTypes::IMAGES)
                        ->setDirTypeID(MediaDestiny::DESTINY_INTERNAL)
                        ->setTargetDirSystem()
                        ->uploadMedia();
            } catch (Exception $e) {
                return false;
            }

            if (!$media) {
               return false;
            }

            $model->{$key} = $media->id;

            return $model;
        }

        return false;
    }
}
