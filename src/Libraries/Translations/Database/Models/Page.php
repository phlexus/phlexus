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

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

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
        $this->setSource('pages');
    }

    /**
     * Create page
     * 
     * @param string $name Page name
     * 
     * @return mixed Page or null
     */
    public static function createPage(string $name)
    {
        $page = self::findFirstByname($name);

        if ($page) {
            return $page;
        }

        $page       = new self;
        $page->name = $name;

        return $page->save() ? $page : null;
    }
}
