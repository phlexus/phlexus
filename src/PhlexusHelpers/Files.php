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

use Phlexus\Libraries\Media\Models\MediaDestiny;
use Phlexus\Libraries\Media\Models\MediaType;
use Phlexus\Helpers;

class Files
{
    /**
     * Get application upload dir
     * 
     * @return string
     */
    public static function getUploadDir(): string
    {
        $configs = Helpers::phlexusConfig('application')->toArray();

        return $configs['upload_dir'];
    }

    /**
     * Get internal relative dir
     * 
     * @return string
     */
    public static function getInternalRelativeDir(): string
    {
        $uploader = Defaults::getUploader()
                        ->setDirTypeID(MediaDestiny::DESTINY_INTERNAL)
                        ->setTargetDirSystem();

        $fileTypeID = MediaType::TYPE_IMAGE;
        $dirTypeID  = $uploader->getDirTypeID();
        $targetDir  = $uploader->getTargetDir();

        return implode('/', [ $fileTypeID, $dirTypeID, $targetDir]);
    }
}
