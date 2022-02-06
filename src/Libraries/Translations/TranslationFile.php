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

use Phalcon\Translate\Adapter\Gettext;
use Phalcon\Translate\InterpolatorFactory;
use Phalcon\Translate\TranslateFactory;
use Phlexus\Helpers;

class TranslationFile extends TranslationAbstract
{
    /**
     * Setup configs
     */
    private string $filesDir;

    /**
     * Construct language
     */
    public function __construct(string $language) {
        parent::__construct($language);

        $configs = Helpers::phlexusConfig('translations')->toArray();
        
        $this->filesDir = $configs['config']['files_dir'];
    }

    /**
     * Get general translations
     * 
     * @return Gettext
     */
    public function getTranslator()
    {
        return $this->getTranslateFactory('general', self::MESSAGE);
    }

    /**
     * Get translations filtered by page and type
     * 
     * @param string $page Page to translate
     * @param string $type Type to translate
     * 
     * @return Gettext
     */
    public function getTranslatorType(string $page, string $type) {
        return $this->getTranslateFactory($page, $type);
    }

    /**
     * Get translation factory
     * 
     * @param string $page Page to translate
     * @param string $type Type to translate
     * 
     * @return Gettext
     */
    private function getTranslateFactory(string $page, string $type): Gettext {
        $interpolator = new InterpolatorFactory();
        $factory      = new TranslateFactory($interpolator);

        $options = [
            'locale'        => $this->language,
            'defaultDomain' => 'translations',
            'directory'     => $this->filesDir . !empty($page) ? '/' . $page : '',
            'category'      => (int) implode('', array_map('ord', str_split($type))),
        ];

        return $factory->newInstance('gettext', $options);
    }
}