<?php
declare(strict_types=1);

namespace Phlexus\Libraries\Translations\Database\Models;

use Phalcon\Mvc\Model;

/**
 * Class Language
 *
 * @package Phlexus\Libraries\Translations\Database\Models
 */
class Language extends Model
{
    public const DISABLED = 0;

    public const ENABLED = 1;

    public $id;

    public $iso;

    public $language;

    public $active;

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize()
    {
        $this->setSource('language');
    }
}
