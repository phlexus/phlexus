<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Helpers;
use Phlexus\Models\Settings;
use Phlexus\Modules\BaseUser\Models\User;

class SecurityLoaderProvider extends AbstractProvider
{
    /**
     * Configuration app hash key name
     */
    protected const APP_HASH_PARAM_KEY = 'app_hash';

    /**
     * Provider name
     *
     * @var string
     */
    protected string $providerName = 'security';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * 
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $user = User::getUser();

        $configs = Helpers::phlexusConfig($this->providerName)->toArray();

        $security = $this->di->getShared($this->providerName);

        $database = Settings::getDatabasekey();

        $this->di->remove($this->providerName);

        $this->di->setShared($this->providerName, function () use ($security, $user, $configs, $database) {
            $appHash  = isset($configs[self::APP_HASH_PARAM_KEY]) ? $configs[self::APP_HASH_PARAM_KEY] : '';
            $userHash = $user !== null ? $user->userHash : '';

            $security->setAppHash($appHash);
            $security->setUserHash($userHash);
            $security->setDatabaseHash($database);

            return $security;
        });
    }
}
