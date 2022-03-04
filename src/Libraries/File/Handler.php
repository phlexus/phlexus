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

namespace Phlexus\Libraries\File;

use Phlexus\Security;
use Phlexus\Helpers;
use Phalcon\Http\Request\File;

class Handler
{

    public const FILEIMAGE = 'image';

    public const USERDESTINY = 'user';

    private File $file;

    private string $fileDestiny;

    private string $fileType;

    private string $uploadDirectory;

    private string $uploadName;

    /**
     * Construct
     */
    public function __construct(File $file) {
        $this->file = $file;
    }

    /**
     * Get upload directory
     * 
     * @return string
     */
    public function getUploadDir(): string
    {
        return $this->$uploadDirectory;
    }

    /**
     * Set upload directory
     * 
     * @param string $directory
     * 
     * @return string
     */
    public function setUploadDir($directory): void
    {
        $this->$uploadDirectory = $directory;
    }

    /**
     * Get default upload directory
     * 
     * @param string $directory
     * 
     * @return string
     */
    public function getDefaultUploadDir(): string
    {
        $fileDestiny = $this->getFileDestiny();

        $fileType = $this->getFileType();
   
        $uploadDir = '';

        switch ($fileType) {
            case self::FILEIMAGE:
            default:
                $uploadDir = $fileType;
                break;
        }

        switch ($fileDestiny) {
            case self::USERDESTINY:
            default:
                $uploadDir .= $fileDestiny;
                break;
        }

        return $uploadDir;
    }

    /**
     * Get upload name
     * 
     * @return string
     */
    public function getUploadName(): string
    {
        return $this->$uploadName;
    }

    /**
     * Set upload name
     * 
     * @param string $name
     * 
     * @return string
     */
    public function setUploadName($name): void
    {
        $this->$uploadName = $name;
    }

    /**
     * Get default upload name
     * 
     * @return string
     */
    public function getDefaultUploadName(): string
    {
        
    }

    /**
     * Set file destiny
     * 
     * @return string
     */
    public function getFileDestiny(): string
    {
        return $this->$fileDestiny;
    }

    /**
     * Get file destiny
     * 
     * @param string $fileDestiny
     * 
     * @return string
     */
    public function setFileDestiny($fileDestiny): void
    {
        $this->$fileDestiny = $fileDestiny;
    }

    /**
     * Set file type
     * 
     * @return string
     */
    public function getFileType(): string
    {
        return $this->$fileType;
    }

    /**
     * Get file type
     * 
     * @param string $fileType
     * 
     * @return string
     */
    public function setFileType($fileType): void
    {
        $this->$fileType = $fileType;
    }

    /**
     * Move file
     * 
     * @return bool
     */
    public function moveFile(): bool
    {
        return $file->moveTo($this->getUploadDir() . $this->getUploadName());
    }

    /**
     * Upload file
     * 
     * @return bool
     */
    public function uploadFile(): bool
    {
        $this->setUploadDir($this->getDefaultUploadDir());
        $this->setUploadName($this->getDefaultUploadName());

        return $this->moveFile();
    }
}
