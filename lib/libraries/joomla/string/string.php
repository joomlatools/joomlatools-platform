<?php
/**
 * @package     Joomla.Platform
 * @subpackage  String
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

use \Joomla\String\StringHelper;

/**
 * String handling class for utf-8 data
 * Wraps the phputf8 library
 * All functions assume the validity of utf-8 strings.
 *
 * @since       11.1
 * @deprecated  4.0  Use {@link \Joomla\String\StringHelper} instead unless otherwise noted.
 */
abstract class JString extends StringHelper
{
    /**
     * Does a UTF-8 safe version of PHP parse_url function
     *
     * @param   string  $url  URL to parse
     *
     * @return  mixed  Associative array or false if badly formed URL.
     *
     * @see     http://us3.php.net/manual/en/function.parse-url.php
     * @since   11.1
     * @deprecated  4.0 (CMS) - Use {@link \Joomla\Uri\UriHelper::parse_url()} instead.
     */
    public static function parse_url($url)
    {
        JLog::add('JString::parse_url has been deprecated. Use \\Joomla\\Uri\\UriHelper::parse_url.', JLog::WARNING, 'deprecated');

        return \Joomla\Uri\UriHelper::parse_url($url);
    }
}
