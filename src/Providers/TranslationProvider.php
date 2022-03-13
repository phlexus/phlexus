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

use Phlexus\Libraries\Translations\TranslationFactory;
use Phlexus\Libraries\Translations\TranslationAbstract;

class TranslationProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected string $providerName = 'translation';

    /**
     * Register application service.
     *
     * @psalm-suppress UndefinedMethod
     *
     * @param array $parameters Custom parameters for Service Provider
     */
    public function register(array $parameters = []): void
    {
        $language = $this->request->getBestLanguage();
        $di       = $this->getDI();

        $this->getDI()->setShared($this->providerName, function () use ($di, $language) {
            $router = $di->getShared('router');

            $module     = $router->getModuleName();
            $controller = $router->getControllerName();
            $action     = $router->getActionName();

            $bundle = $module . '_' . $controller . '_' . $action;

            return (new TranslationFactory())->build($language)
                                             ->setPageType($bundle, TranslationAbstract::PAGE);
        });
    }
}
