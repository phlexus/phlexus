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

use Phalcon\Mvc\View;
use Exception;

class Emails
{
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
           throw new Exception('No template to render');
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
       $mail = Defaults::getEmail();

       // If not inside Phlexus cms
       if (!$mail) {
           return false;
       }

       $mail->addAddress($email);
       $mail->Subject = $subject;
       $mail->Body    = $body;

       return $mail->send();
   }
}