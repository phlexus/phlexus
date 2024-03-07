<?php

/**
 * This file is part of the Phlexus CMS.
 *
 * (c) Phlexus CMS <cms@phlexus.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Helpers;
use Phalcon\Storage\Adapter\Redis;
use Phalcon\Storage\SerializerFactory;

class RedisProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected string $providerName = 'redis';

    /**
     * Register application service.
     *
     * @psalm-suppress UndefinedMethod
     *
     * @param array $parameters Custom parameters for Service Provider
     *
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $cache = Helpers::phlexusConfig('cache')->toArray();

        if (!isset($cache[$this->providerName])) {
            return;
        }

        $configs = $cache[$this->providerName];

        $this->getDI()->setShared($this->providerName, function () use ($configs) {
            $serializerFactory = new SerializerFactory();

            return new Redis($serializerFactory, $configs['config']);
        });
    }
}
