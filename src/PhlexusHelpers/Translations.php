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

namespace Phlexus\PhlexusHelpers;

class Translations
{
    private const FALLBACK_LANGUAGE = 'en-us';

    public static function getBestLanguage()
    {
        $request = Defaults::getRequest();

        $bestLanguage = strtolower($request->getBestLanguage());

        if (preg_match('/^[a-z]{2}-[a-z]{2}$/', $bestLanguage) === 0) {
            return self::FALLBACK_LANGUAGE;
        }

        return $bestLanguage;
    }
}
