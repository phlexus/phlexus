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

class TranslationDatabase extends TranslationAbstract
{
    /**
     * Get general translations
     * 
     * @return NativeArray
     */
    public function getTranslator(): NativeArray
    {
        $this->getTranslateFactory('general', self::MESSAGE);
    }

    /**
     * Get translations filtered by page and type
     * 
     * @param string $page Page to translate
     * @param string $type Type to translate
     * 
     * @return NativeArray
     */
    public function getTranslatorType(string $page, string $type): NativeArray {
        $this->getTranslateFactory($page, $type);
    }

    /**
     * Get translation factory
     * 
     * @param string $page Page to translate
     * @param string $type Type to translate
     * 
     * @return NativeArray
     */
    private function getTranslateFactory(string $page, string $type): NativeArray {        
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