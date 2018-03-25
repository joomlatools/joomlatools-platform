<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  Version
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Version information class for the Joomla CMS.
 *
 * @since  1.0
 */
final class JVersion
{
	/**
	 * Product name.
	 *
	 * @var    string
	 */
	const PRODUCT = 'Joomlatools Platform';

	/**
	 * Release version.
	 *
	 * @var    string
	 */
	const RELEASE = '3.6';

	/**
	 * Maintenance version.
	 *
	 * @var    string
	 */
	const DEV_LEVEL = '5';

	/**
	 * Development status.
	 *
	 * @var    string
	 */
	const DEV_STATUS = 'Stable';

	/**
	 * Build number.
	 *
	 * @var    string
	 */
	const BUILD = '103';

	/**
	 * Code name.
	 *
	 * @var    string
	 */
	const CODENAME = 'Braveheart';

	/**
	 * Release date.
	 *
	 * @var    string
	 */
	const RELDATE = '01-February-2016';

	/**
	 * Release time.
	 *
	 * @var    string
	 */
	const RELTIME = '00:00';

	/**
	 * Release timezone.
	 *
	 * @var    string
	 */
	const RELTZ = 'GMT';

	/**
	 * Copyright Notice.
	 *
	 * @var    string
	 */
	const COPYRIGHT = 'Copyright (C) 20015 Johan Janssens. All rights reserved.';

	/**
	 * Link text.
	 *
	 * @var    string
	 */
	const URL = '<a href="http://developer.joomlatools.com/platform">Joomlatools Platform</a> is Free Software released under the GNU General Public License.';

    /** @var string Media version */
    private $mediaVersion;

	/**
	 * Magic getter providing access to constants previously defined as class member vars.
	 *
	 * @param   string  $name  The name of the property.
	 *
	 * @return  mixed   A value if the property name is valid.
	 *
	 * @since   3.5
	 * @deprecated  4.0  Access the constants directly
	 */
	public function __get($name)
	{
		if (defined("JVersion::$name"))
		{
			JLog::add(
				'Accessing JVersion data through class member variables is deprecated, use the corresponding constant instead.',
				JLog::WARNING,
				'deprecated'
			);

			return constant("JVersion::$name");
		}

		$trace = debug_backtrace();
		trigger_error(
			'Undefined constant via __get(): ' . $name . ' in ' . $trace[0]['file'] . ' on line ' . $trace[0]['line'],
			E_USER_NOTICE
		);
	}

	/**
	 * Check if we are in development mode
	 *
	 * @return  boolean
	 *
	 * @since   3.4.3
	 */
	public function isInDevelopmentState()
	{
		return strtolower(self::DEV_STATUS) != 'stable';
	}

	/**
	 * Compares two a "PHP standardized" version number against the current Joomla version.
	 *
	 * @param   string  $minimum  The minimum version of the Joomla which is compatible.
	 *
	 * @return  boolean True if the version is compatible.
	 *
	 * @see     https://secure.php.net/version_compare
	 * @since   1.0
	 */
	public function isCompatible($minimum)
	{
		return version_compare(JVERSION, $minimum, 'ge');
	}

	/**
	 * Method to get the help file version.
	 *
	 * @return  string  Version suffix for help files.
	 *
	 * @since   1.0
	 */
	public function getHelpVersion()
	{
		return '.' . str_replace('.', '', self::RELEASE);
	}

	/**
	 * Gets a "PHP standardized" version string for the current Joomla.
	 *
	 * @return  string  Version string.
	 *
	 * @since   1.5
	 */
	public function getShortVersion()
	{
		return self::RELEASE . '.' . self::DEV_LEVEL;
	}

	/**
	 * Gets a version string for the current Joomla with all release information.
	 *
	 * @return  string  Complete version string.
	 *
	 * @since   1.5
	 */
	public function getLongVersion()
	{
		return self::PRODUCT . ' ' . self::RELEASE . '.' . self::DEV_LEVEL . ' '
			. self::DEV_STATUS . ' [ ' . self::CODENAME . ' ] ' . self::RELDATE . ' '
			. self::RELTIME . ' ' . self::RELTZ;
	}

	/**
	 * Returns the user agent.
	 *
	 * @param   string  $component    Name of the component.
	 * @param   bool    $mask         Mask as Mozilla/5.0 or not.
	 * @param   bool    $add_version  Add version afterwards to component.
	 *
	 * @return  string  User Agent.
	 *
	 * @since   1.0
	 */
	public function getUserAgent($component = null, $mask = false, $add_version = true)
	{
		if ($component === null)
		{
			$component = 'Framework';
		}

		if ($add_version)
		{
			$component .= '/' . self::RELEASE;
		}

		// If masked pretend to look like Mozilla 5.0 but still identify ourselves.
		if ($mask)
		{
			return 'Mozilla/5.0 ' . self::PRODUCT . '/' . self::RELEASE . '.' . self::DEV_LEVEL . ($component ? ' ' . $component : '');
		}
		else
		{
			return self::PRODUCT . '/' . self::RELEASE . '.' . self::DEV_LEVEL . ($component ? ' ' . $component : '');
		}
	}

	/**
	 * Generate a media version string for assets
	 * Public to allow third party developers to use it
	 *
	 * @return  string
	 *
	 * @since   3.2
	 */
	public function generateMediaVersion()
	{
		$config = JFactory::getConfig();
		return md5($this->getLongVersion() . $config->get('secret'));
	}

	/**
	 * Gets a media version which is used to append to Joomla core media files.
	 *
	 * This media version is used to append to Joomla core media in order to trick browsers into
	 * reloading the CSS and JavaScript, because they think the files are renewed.
	 * The media version is renewed after Joomla core update, install, discover_install and uninstallation.
	 *
	 * @return  string  The media version.
	 *
	 * @since   3.2
	 */
	public function getMediaVersion()
	{
		if (empty($this->mediaVersion)) {
			$this->mediaVersion = $this->generateMediaVersion();
		}

		return $this->mediaVersion;
	}

	/**
	 * Function to refresh the media version
	 *
	 * @return  JVersion  Instance of $this to allow chaining.
	 *
	 * @since   3.2
	 */
	public function refreshMediaVersion()
	{
		$mediaVersion = $this->generateMediaVersion();
		return $this->setMediaVersion($mediaVersion);
	}

	/**
	 * Sets the media version which is used to append to Joomla core media files.
	 *
	 * @param   string  $mediaVersion  The media version.
	 *
	 * @return  JVersion  Instance of $this to allow chaining.
	 *
	 * @since   3.2
	 */
	public function setMediaVersion($mediaVersion)
	{
		if (!empty($mediaVersion)) {
			$this->mediaVersion = $mediaVersion;
		}

		return $this;
	}
}
