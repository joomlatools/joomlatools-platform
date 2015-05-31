<?php
/**
 * @package    Joomla.Cli
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// Initialize Joomla framework
const _JEXEC = 1;

define('JPATH_BASE', dirname(__DIR__));
define('JPATH_ROOT', dirname(__DIR__));
require_once JPATH_ROOT . '/web/defines.php';

// Get the framework.
require_once JPATH_LIBRARIES . '/import.legacy.php';

// Bootstrap the CMS libraries.
require_once JPATH_LIBRARIES . '/cms.php';

/**
 * Cron job to trash expired cache data
 *
 * @package  Joomla.Cli
 * @since    2.5
 */
class GarbageCron extends JApplicationCli
{
	/**
	 * Entry point for the script
	 *
	 * @return  void
	 *
	 * @since   2.5
	 */
	public function doExecute()
	{
		$cache = JFactory::getCache();
		$cache->gc();
	}
}

JApplicationCli::getInstance('GarbageCron')->execute();
