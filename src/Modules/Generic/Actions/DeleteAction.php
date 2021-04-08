<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phalcon\Http\ResponseInterface;

/**
 * Trait DeleteAction
 *
 * @package Phlexus\Modules\Generic\Actions
 */
trait DeleteAction {
    
    use \Phlexus\Modules\Generic\Model;

    /**
     * Delete Action
     *
     * @param int $id The model id
     * 
     * @return ResponseInterface
     */
    public function deleteAction(int $id): ResponseInterface {
        $this->view->disable();

        $defaultRoute = $this->getBasePosition();

        //Response instance
        $response = new \Phalcon\Http\Response();

        //Content of the response
        $response = ['status' => 0];

        if(!$this->request->isPost() 
            || !$this->security->checkToken('csrf', $this->request->getPost('csrf', null))) {
            return $this->response->setJsonContent($response);
        }

        $record = $this->getModel()->findFirstByid($id);

        if($record) {
            $record->active = 0;

            if($record->save()) { 
                $response['status'] = 1;
            }
        }

        return $this->response->setJsonContent($response);
    }
}