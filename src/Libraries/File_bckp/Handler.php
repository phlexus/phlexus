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

use Phlexus\Libraries\Media\Models\MediaType;
use Phlexus\Libraries\Media\Models\MediaDestiny;
use Phlexus\Security;
use Phlexus\Libraries\Helpers;
use Phlexus\Modules\BaseUser\Models\User;
use Phalcon\Http\Request\File;
use Phalcon\DI;

class Handler
{
    private File $file;

    private int $fileDestiny;

    private int $fileType;

    private string $userDirectory;

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
        return $this->uploadDirectory;
    }

    /**
     * Set upload directory
     * 
     * @param string $directory
     * 
     * @return Handler
     */
    public function setUploadDir($directory): Handler
    {
        $this->uploadDirectory = $directory;

        return $this;
    }

    /**
     * Get default upload directory
     * 
     * @param string $directory
     * 
     * @return string
     * 
     * @throws Exception
     */
    public function getDefaultUploadDir(): string
    {
        $fileDestiny = $this->getFileDestiny();

        $fileType = $this->getFileType();
   
        $uploadDir = Helpers::getUploadDir();

        return $uploadDir . $fileType . '/' . $fileDestiny;
    }

    /**
     * Get upload name
     * 
     * @return string
     */
    public function getUploadName(): string
    {
        return $this->uploadName;
    }

    /**
     * Set upload name
     * 
     * @param string $name
     * 
     * @return Handler
     */
    public function setUploadName($name): Handler
    {
        $this->uploadName = $name;
        
        return $this;
    }

    /**
     * Get default upload name
     * 
     * @return string
     */
    public function getDefaultUploadName(): string
    {
        $user = User::getUser();
        
        $fileName = $user->user_hash . $this->file->getName();

        return base64_encode(Di::getDefault()->getShared('security')->getUserToken($fileName));
    }

    /**
     * Get file destiny
     * 
     * @return int
     */
    public function getFileDestiny(): int
    {
        return $this->fileDestiny;
    }

    /**
     * Set file destiny
     * 
     * @param string $fileDestiny
     * 
     * @return Handler
     * 
     * @throws Exception
     */
    public function setFileDestiny($fileDestiny): Handler
    {
        switch ($fileDestiny) {
            case MediaDestiny::DESTINY_USER:
                $this->fileDestiny = $fileDestiny;
                break;
            default:
                throw new \Exception('Destiny not supported');
                break;
        }

        return $this;
    }

    /**
     * Get file type
     * 
     * @return int
     * 
     * @throws Exception
     */
    public function getFileType(): int
    {
        $mimeType = $this->file->getType();

        $fileType = '';

        switch ($mimeType) {
            case 'image/png':
            case 'image/jpg':
                $fileType = MediaType::TYPE_IMAGE;
                break;
            default:
                throw new \Exception('MimeType not supported');
                break;
        }

        return $fileType;
    }

    /**
     * Move file
     * 
     * @return bool
     */
    public function moveFile(): bool
    {
        $uploadDir = $this->getUploadDir();

        if (!file_exists($uploadDir)) {
            return false;
        }

        return $this->file->moveTo($uploadDir . '/' . $this->getUploadName());
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
