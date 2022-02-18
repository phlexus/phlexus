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
use Phlexus\Libraries\Translations\Redis;
use Phlexus\Libraries\Translations\Database\DatabaseAdapter;
use Phlexus\Libraries\Translations\Database\Models\Translation as TranslationModel;
use Phalcon\Translate\Adapter\AdapterInterface;
use Phalcon\Translate\InterpolatorFactory;
use Phalcon\Translate\TranslateFactory;

class TranslationRedis extends TranslationAbstract
{
    /**
     * Get translation factory
     * 
     * @param string $page Page to translate
     * @param string $type Type to translate
     * 
     * @return AdapterInterface
     */
    public function getTranslateFactory(string $page, string $type): AdapterInterface {
        $page = strtolower($page);

        $translations = $this->getAll($page, $type);

        $redis = new Redis(
            [
                'locale' => $this->language,
                'page'   => $page,
                'type'   => $type,
                'redis'  => $this->redis,
                'levels' => 5,
            ]
        );

        foreach ($translations as $key => $translation) {
            // If key already exists, assume it's already loaded
            if ($redis->exists($key)) {
                break;
            }

            $redis->add($key, $translation);
        }

        return $redis;
    }

    /**
     * Get all translations
     * 
     * @param string $page Page to translate
     * @param string $type Type to translate
     * 
     * @return array
     */
    private function getAll(string $page, string $type): array {
        $translations = TranslationModel::getTranslationsType($page, $type, $this->language);

        // Fallback to default language
        if (count($translations) === 0 && isset($this->defaultLanguage)) {
            $this->language = $this->defaultLanguage;
            $translations = TranslationModel::getTranslationsType($page, $type, $this->language);
        }

        $parsedTranslations = [];
        
        array_walk($translations, function (&$value,$key) use (&$parsedTranslations) {
            $parsedTranslations[ $value['key'] ] = $value['translation'];
        });

        return $parsedTranslations;
    }
}