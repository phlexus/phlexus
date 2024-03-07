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

class Arrays
{
    /**
     * Group array by key
     * 
     * @param array  $array Array to split
     * @param string $key   Key to match before split
     * 
     * @return array
     */
    public static function groupArrayByKey(array $array, string $key) : array
    {
        $newArray = [];

        foreach ($array as $pos => $item) {
            $newArray[$item[$key]][] = $item;
        }

        return $newArray;
    }

    /**
     * Group array by keys
     *
     * @param array  $array Array to split
     * @param array  $keys  Keys to group
     * @param string $key   Key to agroup to
     * 
     * @return array
     */
    public static function groupArray(array $array, array $keys, $key = null) : array
    {
        $groupedArray = [];

        $i = 0;
        foreach ($array as $pos => $item) {
            if (!is_array($item)) {
                $groupedArray[$pos] = $item;
                continue;
            } else if (self::isMultiDimensional($item)) {
                $groupedArray[$pos] = self::groupArray($item, $keys, $key);
                continue;
            }

            $groupedArray = array_merge($groupedArray, $item);

            foreach ($keys as $k) {
                if (!isset($item[$k])) {
                    continue;
                }

                unset($groupedArray[$k]);

                if ($key) {
                    $groupedArray[$key][$i][$k] = $item[$k];
                } else {
                    $groupedArray[$k][$i] = $item[$k];
                }
            }

            $i++;
        }

        return $groupedArray;
    }

    /**
     * Is multidimensional
     *
     * @param array  $array Array to verify
     * 
     * @return bool
     */
    public static function isMultiDimensional(array $array) : bool
    {
        return is_array($array) && is_array(current($array));
    }
}