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
use Phalcon\Translate\Adapter\AdapterInterface;

abstract class TranslationAbstract extends Injectable implements TranslationInterface
{
    /**
     * PAGE
     */
    public const PAGE = 'page';

    /**
     * Message
     */
    public const MESSAGE = 'message';

    /**
     * Form
     */
    public const FORM = 'form';

    /**
     * Language
     */
    protected string $language;

    /**
     * Default Language
     */
    protected string $defaultLanguage;

    /**
     * Construct language
     * 
     * @param string $language        Preferred language
     * @param string $defaultLanguage Fallback language
     */
    public function __construct(string $language, string $defaultLanguage) {
        if (preg_match('/^[a-zA-Z-]+$/', $language) !== 1) {
            throw new \Exception('Unable to setup translation!');
        }

        $this->language = $language;
        $this->defaultLanguage = $defaultLanguage;
    }


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
}