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

use Phalcon\Di\Di;
use PHPMailer\PHPMailer\PHPMailer;
use Twilio\Rest\Client as SMSClient;

class Defaults
{
    /**
     * Get security
     * 
     * @return Security
     */
    public static function getSecurity(): Security
    {
        return self::getByName('security');
    }
    
    /**
     * Get session
     * 
     * @return SessionManager
     */
    public static function getSession(): SessionManager
    {
        return self::getByName('session');
    }

    /**
     * Get flash message session
     * 
     * @return FlashSession
     */
    public static function getFlashMessage(): FlashSession
    {
        return self::getByName('flash');
    }

    /**
     * Get uploader
     * 
     * @return FlashSession
     */
    public static function getUploader(): FlashSession
    {
        return self::getByName('uploader');
    }

    /**
     * Get email
     * 
     * @return PHPMailer
     */
    public static function getEmail(): PHPMailer
    {
        return self::getByName('email');
    }

    /**
     * Get sms
     * 
     * @return SMSClient
     */
    public static function getSMS(): SMSClient
    {
        return self::getByName('email');
    }

    /**
     * Get by name
     * 
     * @return object|null
     */
    private static function getByName($name): ?object
    {
        return Di::getDefault()->get($name);
    }
}
