<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_languages
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Languages component helper.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_languages
 * @since       1.6
 */
class LanguagesHelper
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName   The name of the active view.
	 * @param   int     $client  The client id of the active view. Maybe be 0 or 1
	 *
	 * @return  void
	 */
	public static function addSubmenu($vName, $client = 0)
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_LANGUAGES_SUBMENU_INSTALLED_SITE'),
			'index.php?option=com_languages&view=installed&client=0',
			$vName == 'installed' && $client === 0
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_LANGUAGES_SUBMENU_INSTALLED_ADMINISTRATOR'),
			'index.php?option=com_languages&view=installed&client=1',
			$vName == 'installed' && $client === 1
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_LANGUAGES_SUBMENU_CONTENT'),
			'index.php?option=com_languages&view=languages',
			$vName == 'languages'
		);
	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return  JObject
	 *
	 * @deprecated  3.2  Use JHelperContent::getActions() instead
	 */
	public static function getActions()
	{
		// Log usage of deprecated function
		JLog::add(__METHOD__ . '() is deprecated, use JHelperContent::getActions() with new arguments order instead.', JLog::WARNING, 'deprecated');

		// Get list of actions
		$result = JHelperContent::getActions('com_languages');

		return $result;
	}
}
