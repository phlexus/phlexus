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

use Phalcon\Di\Injectable;
use Phalcon\Translate\Adapter\NativeArray;

interface TranslationInterface extends Injectable
{
    /**
     * Construct language
     */
    public function __construct(string $language);

    /**
     * Get general translations
     * 
     * @return NativeArray
     */
    public function getTranslator(): NativeArray;

    /**
     * Get translations filtered by page and type
     * 
     * @param string $page Page to translate
     * @param string $type Type to translate
     * 
     * @return NativeArray
     */
    public function getTranslatorType(string $page, string $type): NativeArray;
}