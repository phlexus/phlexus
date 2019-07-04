<?php declare(strict_types=1);

namespace Phlexus\Modules\Admin\Controllers;

use Phalcon\Mvc\Controller;

/**
 * Abstract Admin Controller
 *
 * @package Phlexus\Modules\Admin\Controllers
 */
abstract class AbstractController extends Controller
{
    /**
     * @return void
     */
    public function initialize(): void
    {
        $this->tag->appendTitle(' - Phlexus Admin');
    }
}
