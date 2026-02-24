<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phalcon\Http\ResponseInterface;
use Phlexus\Modules\BaseUser\Models\Profile;

/**
 * Trait DeleteAction
 *
 * @package Phlexus\Modules\Generic\Actions
 */
trait DeleteAction
{    
    use \Phlexus\Modules\Generic\Model;

    /**
     * Delete Action
     *
     * @param int $id The model id
     * 
     * @return ResponseInterface
     */
    public function deleteAction(int $id): ResponseInterface
    {
        $this->view->disable();

        $translationMessage = $this->translation->setPage()->setTypeMessage();

        $isAdmin = Profile::getUserProfile()->isAdmin();

        // Content of the response
        $response = ['success' => 0];

        // Check if user has delete permissions
        if (!$isAdmin) {
            $response['message'] = $translationMessage->_('no-delete-permissions');

            return $this->response->setJsonContent($response);
        }

        if (!$this->request->isPost() 
            || !$this->security->checkToken('csrf', (string) $this->request->getPost('csrf'))) {
            $response['message'] = $translationMessage->_('invalid-form-data');

            return $this->response->setJsonContent($response);
        }

        $model = $this->getModel();

        $record = $model->findFirstByid($id);

        if ($record) {
            $record->active = 0;

            if ($record->save()) {
                $response = [
                    'success'  => true,
                    'message'  => $translationMessage->_('delete-successfully'),
                    'newToken' => $this->security->getToken(),
                ];
            }
        }

        return $this->response->setJsonContent($response);
    }
}
