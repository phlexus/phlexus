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

use Phalcon\Translate\Adapter\NativeArray;
use Phalcon\Translate\InterpolatorFactory;
use Phalcon\Translate\TranslateFactory;

class TranslationFile extends TranslationAbstract
{
    /**
     * Setup configs
     */
    private string $filesDir;

    /**
     * Setup configs
     */
    public function __construct() {
        parent::__construct();

        $configs = Helpers::phlexusConfig('translations')->toArray();
        
        $this->filesDir = $configs['config']['files_dir'];
    }

    /**
     * Get general translations
     * 
     * @return NativeArray
     */
    public function getTranslator(): NativeArray
    {
        return $this->getTranslateFactory('general', self::MESSAGE);
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
        return $this->getTranslateFactory($page, $type);
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

        $options = [
            'locale'        => $this->language,
            'defaultDomain' => 'translations',
            'directory'     => $this->filesDir . !empty($page) ? '/' . $page : '',
            'category'      => $type,
        ];

        return $factory->newInstance('gettext', $options);
    }
}