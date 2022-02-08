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
     * Get translation factory
     * 
     * @param string $page Page to translate
     * @param string $type Type to translate
     * 
     * @return AdapterInterface
     */
    public function getTranslateFactory(string $page, string $type): AdapterInterface {
        $interpolator = new InterpolatorFactory();
        $factory      = new TranslateFactory($interpolator);

        $language  = $this->language . '.UTF-8';
        $directory = $this->filesDir;

        // Fallback to default language if file doesn't exits
        if (!file_exists($directory . '/' . $language . '/LC_MESSAGES/' . $type . '/' . $page . '.mo')) {
            $language = $this->defaultLanguage . '.UTF-8';
        }

        $options = [
            'locale'        => $language,
            'defaultDomain' => (!empty($type) ? $type . '/' : '') . $page,
            'directory'     => $directory,
            'category'      => LC_MESSAGES
        ];

        return $factory->newInstance('gettext', $options);
    }
}