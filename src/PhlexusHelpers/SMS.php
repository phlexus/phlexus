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

class SMS
{
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
        $sms = Defaults::getSMS();

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
