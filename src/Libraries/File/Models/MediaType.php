<?php
declare(strict_types=1);

namespace Phlexus\Libraries\File\Database\Models;

use Phalcon\Mvc\Model;

/**
 * Class MediaType
 *
 * @package Phlexus\Libraries\File\Database\Models
 */
class MediaType extends Model
{
    public const DISABLED = 0;

    public const ENABLED = 1;

    public const TYPE_IMAGE = 1;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $mediaType;

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
        $this->setSource('media_type');
    }
}
