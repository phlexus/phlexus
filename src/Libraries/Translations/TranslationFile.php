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
use Phalcon\Translate\Adapter\AdapterInterface;
use Phalcon\Translate\InterpolatorFactory;
use Phalcon\Translate\TranslateFactory;

class TranslationFile extends TranslationAbstract
{
    /**
     * Setup configs
     */
    private string $filesDir;

    /**
     * Construct language
     * 
     * @param string $language        Preferred language
     * @param string $defaultLanguage Fallback language
     */
    public function __construct(string $language, string $defaultLanguage) {
        parent::__construct($language, $defaultLanguage);

        $configs = Helpers::phlexusConfig('translations')->toArray();
        
        $this->filesDir = $configs['config']['files_dir'];
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

        $language  = $this->language;
        $directory = $this->filesDir;
        $category  = (int) implode('', array_map('ord', str_split($type)));

        // Fallback to default language if file doesn't exits
        if (!file_exists($directory . '/' . $language . '/' . $category . '/' . $page . '.mo')) {
            $language = $this->defaultLanguage;
        }

        $options = [
            'locale'        => $language,
            'defaultDomain' => $page,
            'directory'     => $directory,
            'category'      => $category,
        ];

        return $factory->newInstance('gettext', $options);
    }
}