<?php
declare(strict_types=1);

namespace Phlexus\Modules\Landing\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Tag;

/**
 * Class ErrorsController
 *
 * @package Phlexus\Modules\Landing\Controllers
 */
final class ErrorsController extends Controller
{
    /**
     * 402 Action
     *
     * @return void
     */
    public function show402Action(): void
    {
        $title = $this->translation->setTypePage()->_('title-error-402');

        Tag::setTitle($title);
    }

    /**
     * 404 Action
     *
     * @return void
     */
    public function show404Action(): void
    {
        $title = $this->translation->setTypePage()->_('title-error-404');

        Tag::setTitle($title);
    }

    /**
     * 500 Action
     *
     * @return void
     */
    public function show500Action(): void
    {
        $title = $this->translation->setTypePage()->_('title-error-500');

        Tag::setTitle($title);
    }
}
