<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  Version
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Version information class for the Joomlatools Platform.
 *
 * @package     Joomla.Libraries
 * @subpackage  Version
 * @since       1.0
 */
final class JVersion
{
	/** @var  string  Product name. */
	public $PRODUCT = 'Joomlatools Platform';

	/** @var  string  Release version. */
	public $RELEASE = '3.3';

	/** @var  string  Maintenance version. */
	public $DEV_LEVEL = '6';

	/** @var  string  Development STATUS. */
	public $DEV_STATUS = 'Stable';

	/** @var  string  Build number. */
	public $BUILD = '103';

	/** @var  string  Code name. */
	public $CODENAME = 'Braveheart';

	/** @var  string  Release date. */
	public $RELDATE = '17-August-2015';

	/** @var  string  Release time. */
	public $RELTIME = '00:00';

	/** @var  string  Release timezone. */
	public $RELTZ = 'GMT';

	/** @var  string  Copyright Notice. */
	public $COPYRIGHT = 'Copyright (C) 20015 Johan Janssens. All rights reserved.';

	/** @var  string  Link text. */
	public $URL = '<a href="http://developer.joomlatools.com/platform">Joomlatools Platform</a> is Free Software released under the GNU General Public License.';

    /** @var string Media version */
    private $mediaVersion;

	/**
	 * Compares two a "PHP standardized" version number against the current Joomla version.
	 *
	 * @param   string  $minimum  The minimum version of the Joomla which is compatible.
	 *
	 * @return  bool    True if the version is compatible.
	 *
	 * @see     http://www.php.net/version_compare
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
		return '.' . str_replace('.', '', $this->RELEASE);
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
		return $this->RELEASE . '.' . $this->DEV_LEVEL;
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
		return $this->PRODUCT . ' ' . $this->RELEASE . '.' . $this->DEV_LEVEL . ' '
			. $this->DEV_STATUS . ' [ ' . $this->CODENAME . ' ] ' . $this->RELDATE . ' '
			. $this->RELTIME . ' ' . $this->RELTZ;
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
			$component .= '/' . $this->RELEASE;
		}

		// If masked pretend to look like Mozilla 5.0 but still identify ourselves.
		if ($mask)
		{
			return 'Mozilla/5.0 ' . $this->PRODUCT . '/' . $this->RELEASE . '.' . $this->DEV_LEVEL . ($component ? ' ' . $component : '');
		}
		else
		{
			return $this->PRODUCT . '/' . $this->RELEASE . '.' . $this->DEV_LEVEL . ($component ? ' ' . $component : '');
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
