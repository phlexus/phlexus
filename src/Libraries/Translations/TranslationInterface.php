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

interface TranslationInterface
{
    /**
     * Construct language
     */
    public function __construct(string $language);

    /**
     * Get general translations
     * 
     * @return mixed
     */
    public function getTranslator();

    /**
     * Get translations filtered by page and type
     * 
     * @param string $page Page to translate
     * @param string $type Type to translate
     * 
     * @return mixed
     */
    public function getTranslatorType(string $page, string $type);
}