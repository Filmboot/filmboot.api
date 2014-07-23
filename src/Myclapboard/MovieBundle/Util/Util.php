<?php
/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Myclapboard\MovieBundle\Util;

/**
 * Class Util.
 *
 * @package Myclapboard\MovieBundle\Util
 */
class Util
{
    /**
     * This function is copied from "The perfect PHP clean URL generator"
     * http://cubiq.org/the-perfect-php-clean-url-generator
     *
     * Creates slug with string and delimiter given.
     *
     * @param string $string    The string
     * @param string $delimiter Words delimiter, by default '-'
     *
     * @return string
     */
    public static function getSlug($string, $delimiter = '-')
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $slug = preg_replace('/[^a-zA-Z0-9\/_|+ -]/', '', $slug);
        $slug = strtolower(trim($slug, $delimiter));
        $slug = preg_replace('/[\/_|+ -]+/', $delimiter, $slug);

        return $slug;
    }
}
