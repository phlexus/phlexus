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
     * Build Translations
     * 
     * @return TranslationInterface
     */
    public function build(string $language): TranslationInterface {
        $configs = Helpers::phlexusConfig('translations')->toArray();

        $type = $configs['type'];

        switch ($type) {
            case self::DATABASE:
                return new TranslationDatabase($language);
                break;
            case self::FILE:
            default:
                return new TranslationFile($language);
                break;
        }
    }
}