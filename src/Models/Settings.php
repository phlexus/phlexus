<?php
declare(strict_types=1);

namespace Phlexus\Models;

use Phalcon\Mvc\Model;

/**
 * Class Settings
 *
 * @package Phlexus\Models
 */
class Settings extends Model
{
    private const DATABASEKEY = 'DATABASE_KEY';

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public string $key;

    /**
     * @var string
     */
    public string $value;

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize()
    {
        $this->setSource('settings');
    }

    /**
     * Get database key
     * 
     * @return string
     */
    public static function getDatabaseKey(): string
    {
        $settings = self::findFirst([
            'conditions' => 'key = :key:',
            'bind'       => [
                'key'  => self::DATABASEKEY,
            ],
        ]);

        return $settings ? $settings->value : '';
    }
}
