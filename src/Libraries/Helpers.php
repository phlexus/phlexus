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

namespace Phlexus\Libraries;

use Phalcon\Di\Di;
use Phalcon\Mvc\View;
use Phlexus\Security;
use Phlexus\Helpers as PhlexusHelpers;
use Phlexus\Libraries\Media\Models\MediaDestiny;
use Phlexus\Libraries\Media\Models\MediaType;
use Phalcon\Session\Manager as SessionManager;
use Phalcon\Flash\Session as FlashSession;

class Helpers extends PhlexusHelpers
{
    /**
     * Get application upload dir
     * 
     * @return string
     */
    public static function getUploadDir(): string
    {
        $configs = PhlexusHelpers::phlexusConfig('application')->toArray();

        return $configs['upload_dir'];
    }

    /**
     * Get internal relative dir
     * 
     * @return string
     */
    public static function getInternalRelativeDir(): string
    {
        $uploader = Di::getDefault()->get('uploader')
                                    ->setDirTypeID(MediaDestiny::DESTINY_INTERNAL)
                                    ->setTargetDirSystem();

        $fileTypeID = MediaType::TYPE_IMAGE;
        $dirTypeID  = $uploader->getDirTypeID();
        $targetDir  = $uploader->getTargetDir();

        return implode('/', [ $fileTypeID, $dirTypeID, $targetDir]);
    }

    /**
     * Get security
     * 
     * @return Security
     */
    public static function getSecurity(): Security
    {
        return Di::getDefault()->get('security');
    }
    
    /**
     * Get session
     * 
     * @return SessionManager
     */
    public static function getSession(): SessionManager
    {
        return Di::getDefault()->get('session');
    }

    /**
     * Get flash message session
     * 
     * @return FlashSession
     */
    public static function getFlashMessage(): FlashSession
    {
        return Di::getDefault()->get('flash');
    }

     /**
     * Renders an email template
     *
     * @param View   $view     Mvc View 
     * @param string $main     Main dir name
     * @param string $template Template to render
     * @param array  $vars     Vars array to render
     * 
     * @return string
     * 
     * @throws Exception
     */
    public static function renderEmail(View $view, string $main, string $template, $vars = []): string
    {
        $view->setViewsDir($view->getViewsDir() . 'emails/');

        $render = $view->getRender($main, $template, $vars);

        if (empty($render)) {
            throw new \Exception('No template to render');
        }

        return $render;
    }

    /**
     * Send an email
     *
     * @param string $email   Email receiver
     * @param string $subject Email subject
     * @param string $body    Email body
     * 
     * @return bool
     */
    public static function sendEmail(string $email, string $subject, string $body): bool
    {
        $mail = Di::getDefault()->getShared('email');

        // If not inside Phlexus cms
        if (!$mail) {
            return false;
        }

        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        return $mail->send();
    }

    /**
     * Send an sms
     *
     * @param string $destNumber Destiny number
     * @param string $message    Message
     * 
     * @return bool
     */
    public static function sendSms(string $destNumber, string $message): bool
    {
        $sms = Di::getDefault()->getShared('sms');

        // If not inside Phlexus cms
        if (!$sms) {
            return false;
        }

        return $sms->messages->create(
            $destNumber,
            [
              'from' => '',
              'body' => $message,
            ]
        );
    }
}
