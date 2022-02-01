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
use Phalcon\Translate\Adapter\NativeArray;
use Phalcon\Translate\InterpolatorFactory;
use Phalcon\Translate\TranslateFactory;

class TranslationFile extends Injectable
{
    /**
     * @return NativeArray
     */
    public function getTranslator(string $language): NativeArray
    {
        $configs = Helpers::phlexusConfig('translations')->toArray();

        $messages = [];
        
        $files_dir = $configs['config']['files_dir'];

        $translationFile = $files_dir . $language . '.php';

        if (true !== file_exists($translationFile)) {
            $translationFile = $files_dir . '/en.php';
        }
        
        require $translationFile;

        $interpolator = new InterpolatorFactory();
        $factory      = new TranslateFactory($interpolator);
        
        return $factory->newInstance(
            'array',
            [
                'content' => $messages,
            ]
        );
    }
}