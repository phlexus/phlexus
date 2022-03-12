<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Modules\BaseUser\Acl\DefaultAcl;

class ACLProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected string $providerName = 'acl';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     *
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $this->di->setShared($this->providerName, function () {
            return new DefaultAcl();
        });
    }
}
