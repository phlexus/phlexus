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

namespace Phlexus\Libraries\Translations;

use Phalcon\Di;
use Phalcon\Translate\Adapter\Database;
use Phalcon\Translate\Adapter\AdapterInterface;

class TranslationDatabase extends TranslationAbstract
{
    /**
     * Get general translations
     * 
     * @return AdapterInterface
     */
    public function getTranslator(): AdapterInterface
    {
        $this->getTranslateFactory('general', self::MESSAGE);
    }

    /**
     * Get translations filtered by page and type
     * 
     * @param string $page Page to translate
     * @param string $type Type to translate
     * 
     * @return AdapterInterface
     */
    public function getTranslatorType(string $page, string $type): AdapterInterface {
        $this->getTranslateFactory($page, $type);
    }

    /**
     * Get translation factory
     * 
     * @param string $page Page to translate
     * @param string $type Type to translate
     * 
     * @return AdapterInterface
     */
    private function getTranslateFactory(string $page, string $type): AdapterInterface {        
        $interpolator = new InterpolatorFactory();
        $factory      = new TranslateFactory($interpolator);

        $translations = [];

        return $factory->newInstance(
            'array',
            [
                'content' => $translations,
            ]
        );
    }
}