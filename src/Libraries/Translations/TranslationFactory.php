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
use Phalcon\Translate\Adapter\NativeArray;

class TranslationFactory
{
    /**
     * File translation identifier
     */
    public const FILE = 'file';

    /**
     * Database translation identifier
     */
    public const DATABASE = 'database';

    /**
     * Redis translation identifier
     */
    public const REDIS = 'redis';

    /**
     * Build Translations
     * 
     * @return TranslationInterface
     */
    public function build(string $language): TranslationInterface {
        $configs = Helpers::phlexusConfig('translations')->toArray();

        $type = $configs['type'];

        $defaultLanguage = $configs['config']['default_language'];

        switch ($type) {
            case self::DATABASE:
                return new TranslationDatabase($language, $defaultLanguage);
                break;
            case self::REDIS:
                return new TranslationRedis($language, $defaultLanguage);
                break;
            case self::FILE:
            default:
                return new TranslationFile($language, $defaultLanguage);
                break;
        }
    }
}