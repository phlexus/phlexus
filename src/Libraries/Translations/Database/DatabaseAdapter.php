<?php
declare(strict_types=1);

namespace Phlexus\Libraries\Translations\Database;

use Phalcon\Mvc\Model;
use Phalcon\Translate\Adapter\AdapterInterface;

class DatabaseAdapter implements AdapterInterface
{
   /**
    * Options
    * @var array
    */
   protected $options;

   /**
    * translations
    * @var array
    */
    private $translations;

    /**
     * @param array $options
     */
    public function __construct(array $options) {
        if (!isset($options['model'])) {
            throw new \Exception("Parameter 'model' is required");
        } else if (!$options['model'] instanceof Model) {
            throw new \Exception("Parameter 'model' must be a Model object");
        }

        if (!isset($options['locale'])) {
            throw new \Exception("Parameter 'locale' is required");
        }

        $this->options = $options;

        if (isset($options['page']) && isset($options['type'])) {
            $this->loadAll($options['page'], $options['type']);
        }
    }

    /**
     * @param string $translateKey
     * @param array  $placeholders
     * 
     * @return string
     */
    public function t(string $translateKey, array $placeholders = []): string {
        return $this->query($translateKey, $placeholders);
    }
    
    /**
     * @param string $translateKey
     * @param array  $placeholders
     * 
     * @return string
     */
    public function _(string $translateKey, array $placeholders = []): string {
        return $this->query($translateKey, $placeholders);
    }

    /**
     * @param string $index
     * @param array  $placeholders
     * 
     * @return string
     */
    public function query(string $index, array $placeholders = []): string {
        $translations = $this->translations;

        return isset($translations[$index]) ? $translations[$index] : $index;
    }

    /**
     * @param  string $index
     * @return bool
     */
    public function exists(string $index): bool {
        return isset($this->translations[$index]) ? true : false;
    }

    /**
     * @return Model
     */
    private function getModel(): Model {
        return $this->options['model'];
    }

    /**
     * Load all translations
     * 
     * @param string $page Page to translate
     * @param string $type Type to translate
     * 
     * @return void
     */
    private function loadAll(string $page, string $type): void {
        $model = $this->getModel();
        $options = $this->options;

        $this->translations = $model::getTranslationsType($page, $type, $options['locale']);

        if (count($this->translations) === 0 && isset($options['defaultLocale'])) {
            $this->translations = $model::getTranslationsType($page, $type, $options['defaultLocale']);
        }
    }
}