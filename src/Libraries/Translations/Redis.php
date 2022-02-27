<?php
declare(strict_types=1);

namespace Phlexus\Libraries\Translations;

use Phalcon\Translate\Adapter\AdapterInterface;
use Phalcon\Translate\Adapter\AbstractAdapter;
use Phalcon\Translate\InterpolatorFactory;
use Phalcon\Translate\Exception;
use Phalcon\Cache\Adapter\Redis as RedisCache;

/**
 * Class Redis
 */
class Redis extends AbstractAdapter implements AdapterInterface
{
    /**
     * Redis object.
     *
     * @var RedisCache
     */
    protected RedisCache $redis;

    /**
     * Locale.
     *
     * @var string
     */
    protected string $locale;

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
     * How much containers to use in Redis for translations. Calculated with 16^$levels.
     *
     * @var integer
     */
    protected int $levels = 2;

    /**
     * Local cache.
     *
     * @var array
     */
    protected array $cache = [];

    /**
     * Class constructor.
     *
     * @param array $options
     *
     * @throws \Phalcon\Translate\Exception
     */
    public function __construct(array $options)
    {
        if (!isset($options['redis'])) {
            throw new Exception("Parameter 'redis' is required");
        } else if (!$options['redis'] instanceof RedisCache) {
            throw new \Exception("Parameter 'redis' must be a Redis object");
        }

        if (!isset($options['locale'])) {
            throw new Exception("Parameter 'locale' is required");
        }

        $this->redis  = $options['redis'];
        $this->locale = $options['locale'];

        $this->page = isset($options['page']) ? $options['page'] : '';
        $this->type = isset($options['type']) ? $options['type'] : '';

        if (isset($options['levels'])) {
            $this->levels = $options['levels'];
        }

        parent::__construct(new InterpolatorFactory, $options);
    }

    /**
     * {@inheritdoc}
     *
     * @param  string  $translateKey
     *
     * @return boolean
     */
    public function exists(string $translateKey): bool
    {
        $index = $this->getLongKey($translateKey);
        $key   = $this->getShortKey($index);

        $this->loadValueByKey($key);

        return (isset($this->cache[$key]) && isset($this->cache[$key][$index]));
    }

    /**
     * {@inheritdoc}
     *
     * @param  string $translateKey
     * @param  array  $placeholders
     *
     * @return string
     */
    public function query(string $translateKey, array $placeholders = []): string
    {
        $index = $this->getLongKey($translateKey);
        $key   = $this->getShortKey($index);

        $this->loadValueByKey($key);

        $value = isset($this->cache[$key]) && isset($this->cache[$key][$index])
            ? $this->cache[$key][$index]
            : $translateKey;
        
        return $this->replacePlaceholders($value, $placeholders);
    }

    /**
     * Adds a translation for given key (No existence check!)
     *
     * @param  string  $translateKey
     * @param  string  $message
     *
     * @return boolean
     */
    public function add(string $translateKey, string $message): bool
    {
        $index = $this->getLongKey($translateKey);
        $key   = $this->getShortKey($index);

        $this->loadValueByKey($key);

        if (!isset($this->cache[$key])) {
            $this->cache[$key] = [];
        }

        $this->cache[$key][$index] = $message;

        return $this->redis->set(
            $key,
            serialize($this->cache[$key])
        );
    }

    /**
     * Update a translation for given key (No existence check!)
     *
     * @param  string  $translateKey
     * @param  string  $message
     *
     * @return boolean
     */
    public function update(string $translateKey, string $message): bool
    {
        return $this->add($translateKey, $message);
    }

    /**
     * Deletes a translation for given key (No existence check!)
     *
     * @param  string  $translateKey
     *
     * @return boolean
     */
    public function delete(string $translateKey): bool
    {
        $index    = $this->getLongKey($translateKey);
        $key      = $this->getShortKey($index);
        $nbResult = $this->redis->del($key);

        unset($this->cache[$key]);

        return $nbResult > 0;
    }

    /**
     * Sets (insert or updates) a translation for given key
     *
     * @param  string  $translateKey
     * @param  string  $message
     *
     * @return boolean
     */
    public function set(string $translateKey, string $message): bool
    {
        return $this->exists($translateKey) ?
            $this->update($translateKey, $message) : $this->add($translateKey, $message);
    }

    /**
     * Loads key from Redis to local cache.
     *
     * @param string $key
     *
     * @return void
     */
    protected function loadValueByKey(string $key): void
    {
        if (!isset($this->cache[$key])) {
            $result = $this->redis->get($key);

            if (!$result) {
                return;
            }

            $result = unserialize($result);

            if (is_array($result)) {
                $this->cache[$key] = $result;
            }
        }
    }

    /**
     * Returns long key for index.
     *
     * @param  string $index
     *
     * @return string
     */
    protected function getLongKey(string $index): string
    {
        return md5($this->type . ':' .$this->page . ':' .$this->locale . ':' . $index);
    }

    /**
     * Returns short key for index.
     *
     * @param  string $index
     *
     * @return string
     */
    protected function getShortKey(string $index): string
    {
        return substr($index, 0, $this->levels);
    }
}