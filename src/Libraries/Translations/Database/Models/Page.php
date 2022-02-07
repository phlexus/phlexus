<?php
declare(strict_types=1);

namespace Phlexus\Libraries\Translations\Database\Models;

use Phalcon\Mvc\Model;

/**
 * Class Page
 *
 * @package Phlexus\Libraries\Translations\Database\Models
 */
class Page extends Model
{
    public const DISABLED = 0;

    public const ENABLED = 1;

    public $id;

    public $name;

    public $active;

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize()
    {
        $this->setSource('pages');
    }
}
