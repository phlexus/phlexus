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

use Phalcon\Translate\Adapter\AdapterInterface;

interface TranslationInterface
{
    /**
     * Construct language
     * 
     * @param string $language        Preferred language
     * @param string $defaultLanguage Fallback language
     */
    public function __construct(string $language, string $defaultLanguage);

    /**
     * Set page
     * 
     * @param string $page Page
     * 
     * @return TranslationInterface
     */
    public function setPage(string $page): TranslationInterface;

    /**
     * Set type
     * 
     * @param string $type Type
     * 
     * @return TranslationInterface
     */
    public function setType(string $type): TranslationInterface;

    /**
     * Get translations
     * 
     * @return AdapterInterface
     */
    public function getTranslator(): AdapterInterface;

    /**
     * Get translation factory
     * 
     * @param string $page Page to translate
     * @param string $type Type to translate
     * 
     * @return AdapterInterface
     */
    public function getTranslateFactory(string $page, string $type): AdapterInterface;
}