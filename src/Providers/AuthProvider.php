<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Libraries\Auth\Manager as AuthManager;
use Phlexus\Helpers;

class AuthProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected string $providerName = 'auth';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     *
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $configs = Helpers::phlexusConfig($this->providerName)->toArray();

        $this->di->setShared($this->providerName, function () use ($configs) {
            return new AuthManager($configs['adapter'], $configs['configurations']);
        });
    }
}
