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

abstract class TranslationAbstract extends Injectable implements TranslationInterface
{
    /**
     * PAGE
     */
    public const string PAGE = 'page';

    /**
     * Message
     */
    public const string MESSAGE = 'message';

    /**
     * Form
     */
    public const string FORM = 'form';

    /**
     * Language
     */
    protected string $language;

    /**
     * Construct language
     */
    public function __construct(string $language) {
        if (preg_match('/^[a-zA-Z]+$/', $language) !== 1) {
            throw new \Exception('Unable to setup translation!');
        }

        $this->language = $language;
    }
}