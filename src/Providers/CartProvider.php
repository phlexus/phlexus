<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Modules\Shop\Libraries\Cart\Cart;

class CartProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected string $providerName = 'cart';

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
            return new Cart();
        });
    }
}
