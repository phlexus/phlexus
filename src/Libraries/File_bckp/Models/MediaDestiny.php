<?php
declare(strict_types=1);

namespace Phlexus\Libraries\File\Models;

use Phalcon\Mvc\Model;

/**
 * Class MediaDestiny
 *
 * @package Phlexus\Libraries\File\Models
 */
class MediaDestiny extends Model
{
    public const DISABLED = 0;

    public const ENABLED = 1;

    public const DESTINY_USER = 1;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $mediaDestiny;

    /**
     * @var int
     */
    public $active;

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize()
    {
        $this->setSource('media_destiny');
    }
}
