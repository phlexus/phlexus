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

class Tokens
{
    const DEFAULT_BYTES = 16;

    /**
     * Exists token
     * 
     * @param string $tokenName Token name
     * 
     * @return bool
     */
    public static function exists(string $tokenName): bool
    {
        $session = Defaults::getSession();
        return $session->exists($tokenName);
    }

    /**
     * Get token
     * 
     * @param string $tokenName Token name
     * 
     * @return string|null
     */
    public static function getToken(string $tokenName): ?string
    {
        $session = Defaults::getSession();
        return $session->get($tokenName, null);
    }

    /**
     * Generate token
     * 
     * @param string $tokenName Token name
     * 
     * @return bool
     */
    public static function generate(string $tokenName): string
    {
        $session  = Defaults::getSession();
        $security = Defaults::getSecurity();

        $generatedToken = $security->getSaltBytes(self::DEFAULT_BYTES);
        $session->set($tokenName, $generatedToken);

        return $generatedToken;
    }

    /**
     * Verify token
     * 
     * @param string $tokenName    Token name
     * @param string $compareToken Token to compare
     * @param bool   $removeEqual  Remove token if equal
     * 
     * @return bool
     */
    public static function verifyToken(string $tokenName, string $compareToken, bool $removeEqual = false): bool
    {
        if (!self::exists($tokenName) || empty($compareToken)) {
            return false;
        }

        $sessionToken = self::getToken($tokenName);

        $result = $sessionToken === $compareToken;

        if (!$removeEqual || $result) {
            self::removeToken($tokenName);
        }

        return $result;
    }

    /**
     * Remove token
     * 
     * @param string $tokenName Token name
     * 
     * @return bool
     */
    public static function removeToken(string $tokenName): bool
    {
        if (!self::exists($tokenName)) {
            return false;
        }

        $session = Defaults::getSession();

        $session->remove($tokenName);

        return true;
    }
}