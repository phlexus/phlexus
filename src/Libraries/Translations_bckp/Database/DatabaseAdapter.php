<?php
declare(strict_types=1);

namespace Phlexus\Libraries\Translations\Database;

use Phalcon\Mvc\Model;
use Phalcon\Translate\Adapter\AdapterInterface;
use Phalcon\Translate\Adapter\AbstractAdapter;
use Phalcon\Translate\InterpolatorFactory;

class DatabaseAdapter extends AbstractAdapter implements AdapterInterface
{
   /**
    * Options
    *
    * @var array
    */
   protected array $options;

   /**
    * Translations
    *
    * @var array
    */
    private array $translations;

    /**
     * Model object.
     *
     * @var \Phalcon\Mvc\Model
     */
    protected Model $model;

    /**
     * Locale.
     *
     * @var string
     */
    protected string $locale;

    /**
     * Default defaultLocale
     *
     * @var string
     */
    protected string $defaultLocale;

    /**
     * Page
     *
     * @var string
     */
    protected string $page;

    /**
     * Type
     *
     * @var string
     */
    protected string $type;

    /**
     * Constructor
     * 
     * @param array $options
     */
    public function __construct(array $options) {
        if (!isset($options['model'])) {
            throw new \Exception("Parameter 'model' is required");
        } else if (!$options['model'] instanceof Model) {
            throw new \Exception("Parameter 'model' must be a Model object");
        }

        $this->model = $options['model'];

        if (!isset($options['locale'])) {
            throw new \Exception("Parameter 'locale' is required");
        }

        $this->locale = $options['locale'];

        if (isset($options['defaultLocale'])) {
            $this->defaultLocale = $options['defaultLocale'];
        }

        $this->options = $options;

        if (isset($options['page']) && isset($options['type'])) {
            $this->page = $options['page'];
            $this->type = $options['type'];

            $this->loadAll($this->page, $this->type);
        }

        parent::__construct(new InterpolatorFactory, $options);
    }

    /**
     * Query index for translation
     * 
     * @param string $index
     * @param array  $placeholders
     * 
     * @return string
     */
    public function query(string $index, array $placeholders = []): string {
        $value = $this->exists($index) ? $this->translations[$index] : $index;

        return $this->replacePlaceholders($value, $placeholders);   
    }

    /**
     * Check if index exists
     * 
     * @param  string $index
     * @return bool
     */
    public function exists(string $index): bool {
        return isset($this->translations[$index]) ? true : false;
    }

     /**
     * Adds a translation for given key
     *
     * @param  string  $index
     * @param  string  $message
     *
     * @return boolean
     */
    public function add(string $index, string $message): bool
    {
        if ($this->exists($index)) {
            return false;
        }
        
        if (!$this->model->createTranslationsType(
            $this->page, $this->type, $this->language,
            $index, $message
        )) {
            return false;
        }

        $this->translations[$index] = $message;

        return true;
    }

    /**
     * Update a translation for given key
     *
     * @param  string  $index
     * @param  string  $message
     *
     * @return boolean
     */
    public function update(string $index, string $message): bool
    {
        return $this->add($index, $message);
    }

    /**
     * Deletes a translation for given key
     *
     * @param  string  $index
     *
     * @return boolean
     */
    public function delete(string $index): bool
    {
        if (!$this->exists($index)) {
            return false;
        }

        unset($this->translations[$index]);

        return true;
    }

    /**
     * Sets (insert or updates) a translation for given key
     *
     * @param  string  $index
     * @param  string  $message
     *
     * @return boolean
     */
    public function set(string $index, string $message): bool
    {
        return $this->exists($index) ?
            $this->update($index, $message) : $this->add($index, $message);
    }

    /**
     * @return Model
     */
    private function getModel(): Model {
        return $this->model;
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

        $translations = $model::getTranslationsType($page, $type, $this->locale);

        // Fallback to default language
        if (count($translations) === 0 && isset($this->defaultLocale)) {
            $this->language = $this->defaultLocale;
            $translations = $model::getTranslationsType($page, $type, $this->language);
        }

        $parsedTranslations = [];
        
        array_walk($translations, function (&$value,$key) use (&$parsedTranslations) {
            $parsedTranslations[ $value['key'] ] = $value['translation'];
        });

        $this->translations = $parsedTranslations;
    }
}