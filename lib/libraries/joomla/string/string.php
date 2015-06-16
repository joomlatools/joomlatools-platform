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
 * @package     Joomla.Platform
 * @subpackage  String
 * @since       11.1
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
	 */
	public static function parse_url($url)
	{
		$result = false;

		// Build arrays of values we need to decode before parsing
		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "$", ",", "/", "?", "#", "[", "]");

		// Create encoded URL with special URL characters decoded so it can be parsed
		// All other characters will be encoded
		$encodedURL = str_replace($entities, $replacements, urlencode($url));

		// Parse the encoded URL
		$encodedParts = parse_url($encodedURL);

		// Now, decode each value of the resulting array
		if ($encodedParts)
		{
			foreach ($encodedParts as $key => $value)
			{
				$result[$key] = urldecode(str_replace($replacements, $entities, $value));
			}
		}

		return $result;
	}
}
