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

use Phlexus\Helpers;
use Phlexus\Libraries\Translations\Database\DatabaseAdapter;
use Phlexus\Libraries\Translations\Database\Models\Translation;
use Phalcon\Translate\Adapter\AdapterInterface;
use Phalcon\Translate\InterpolatorFactory;
use Phalcon\Translate\TranslateFactory;

class TranslationFile extends TranslationAbstract
{
    /**
     * Get general translations
     * 
     * @return AdapterInterface
     */
    public function getTranslator(): AdapterInterface
    {
        return $this->getTranslateFactory('general', self::MESSAGE);
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
        return $this->getTranslateFactory($page, $type);
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
        return new DatabaseAdapter(
            [
                'locale'        => $this->language,
                'defaultLocale' => $this->defaultLanguage,
                'model'         => Translation::class,
                'page'          => $page,
                'type'          => $type,
            ]
        );
    }
}