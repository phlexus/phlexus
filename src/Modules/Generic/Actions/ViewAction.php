<?php
declare(strict_types=1);

namespace Phlexus\Modules\Generic\Actions;

use Phlexus\Modules\BaseUser\Models\Profile;
use Phalcon\Mvc\Model\Resultset\Simple;
use Phalcon\Http\ResponseInterface;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Tag;

/**
 * Trait ViewAction
 *
 * @package Phlexus\Modules\Generic\Actions
 */
trait ViewAction
{
    use \Phlexus\Modules\Generic\Model;

    private int $pageLimit = 25;

    private array $viewFields = [];

    private array $relatedViews = [];

    private PaginatorModel $records;

    /**
     * View Action
     *
     * @return mixed ResponseInterface or void
     */
    public function viewAction()
    {
        $defaultTranslation = $this->translation->setPage();

        $defaultRoute = $this->getBasePosition();

        $isAdmin = Profile::getUserProfile()->isAdmin();

        // Check if user has view permissions
        if (!$isAdmin) {
            $this->flash->error($defaultTranslation->setTypeMessage()->_('no-view-permissions'));

            return $this->response->redirect($defaultRoute);
        }

        $title = $defaultTranslation->setTypePage()->_('title-generic-view');

        Tag::appendTitle($title);

        $paginator = $this->getRecords();

        if (!$paginator) {
            $paginator = $this->getModel()::getModelPaginator([], (int) $this->request->get('p', null, 1));
        }
        
        $records = $paginator->paginate();

        $items = $records->getItems();

        $this->view->setVar('display', $this->getViewFields());

        $this->view->setVar('paginate', $records);

        $this->view->setVar('records', array_replace_recursive(
            count($items) > 0 ? $records->getItems()->toArray() : [], 
            $this->translateRelatedFields($records)
        ));

        $this->view->setVar('relatedViews', $this->getRelatedViews());

        $this->view->setVar('defaultRoute', $defaultRoute);

        $this->view->setVar('csrfToken', $this->security->getToken());

        $this->view->pick('generic/view');
    }


    /**
     * Get View Fields
     *
     * @return array The View Fields array
     */
    private function getViewFields(): array
    {
        return $this->viewFields;
    }

    /**
     * Set View Fields
     * 
     * @param array The View Fields array
     * 
     * @return void
     */
    private function setViewFields(array $fields)
    {
        $this->viewFields = $fields;
    }
    
    /**
     * Get Related Views
     *
     * @return array The Related Views array
     */
    private function getRelatedViews(): array
    {
        return $this->relatedViews;
    }

    /**
     * Set Related Views
     * 
     * @param array The Related Views array
     * 
     * @return void
     */
    private function setRelatedViews(array $relatedViews)
    {
        $this->relatedViews = $relatedViews;
    }
    
    /**
     * Get Records
     *
     * @return PaginatorModel|null Records or null
     */
    private function getRecords(): ?PaginatorModel
    {
        return isset($this->records) ? $this->records : null;
    }

    /**
     * Set Records
     * 
     * @param PaginatorModel Records
     * 
     * @return void
     */
    private function setRecords(PaginatorModel $records)
    {
        $this->records = $records;
    }
}