<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  Component
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Component helper class
 *
 * @package     Joomla.Libraries
 * @subpackage  Component
 * @since       1.5
 */
class JComponentHelper
{
	/**
	 * The component list cache
	 *
	 * @var    array
	 * @since  1.6
	 */
	protected static $components = array();

	/**
	 * Get the component information.
	 *
	 * @param   string   $option  The component option.
	 * @param   boolean  $strict  If set and the component does not exist, the enabled attribute will be set to false.
	 *
	 * @return  object   An object with the information for the component.
	 *
	 * @since   1.5
	 */
	public static function getComponent($option, $strict = false)
	{
		if (!isset(static::$components[$option]))
		{
			if (static::load($option))
			{
				$result = static::$components[$option];
			}
			else
			{
				$result = new stdClass;
				$result->enabled = $strict ? false : true;
				$result->params = new JRegistry;
			}
		}
		else
		{
			$result = static::$components[$option];
		}

		return $result;
	}

	/**
	 * Checks if the component is enabled
	 *
	 * @param   string  $option  The component option.
	 *
	 * @return  boolean
	 *
	 * @since   1.5
	 */
	public static function isEnabled($option)
	{
		$result = static::getComponent($option, true);

		return $result->enabled;
	}

	/**
	 * Gets the parameter object for the component
	 *
	 * @param   string   $option  The option for the component.
	 * @param   boolean  $strict  If set and the component does not exist, false will be returned
	 *
	 * @return  JRegistry  A JRegistry object.
	 *
	 * @see     JRegistry
	 * @since   1.5
	 */
	public static function getParams($option, $strict = false)
	{
		$component = static::getComponent($option, $strict);

		return $component->params;
	}

	/**
	 * Applies the global text filters to arbitrary text
	 *
	 * @param   string  $text  The string to filter
	 *
	 * @return  string  The filtered string
	 *
	 * @since   2.5
	 */
	public static function filterText($text)
	{
        $text = JFilterInput::getInstance(array(), array(), 1, 1, 1)->clean($text, 'html');
		return $text;
	}

	/**
	 * Render the component.
	 *
	 * @param   string  $option  The component option.
	 * @param   array   $params  The component parameters
	 *
	 * @return  object
	 *
	 * @since   1.5
	 * @throws  Exception
	 */
	public static function renderComponent($option, $params = array())
	{
		$app = JFactory::getApplication();

		// Load template language files.
		$template = $app->getTemplate(true)->template;
		$lang = JFactory::getLanguage();
		$lang->load('tpl_' . $template, JPATH_BASE, null, false, true)
			|| $lang->load('tpl_' . $template, JPATH_THEMES . "/$template", null, false, true);

		if (empty($option))
		{
			throw new Exception(JText::_('JLIB_APPLICATION_ERROR_COMPONENT_NOT_FOUND'), 404);
		}

		// Record the scope
		$scope = $app->scope;

		// Set scope to component name
		$app->scope = $option;

		// Build the component path.
		$option = preg_replace('/[^A-Z0-9_\.-]/i', '', $option);
		$file = substr($option, 4);

		// Define component path.
		define('JPATH_COMPONENT', JPATH_BASE . '/components/' . $option);
		define('JPATH_COMPONENT_SITE', JPATH_SITE . '/components/' . $option);
		define('JPATH_COMPONENT_ADMINISTRATOR', JPATH_ADMINISTRATOR . '/components/' . $option);

		$path = JPATH_COMPONENT . '/' . $file . '.php';

		// If component is disabled throw error
		if (!static::isEnabled($option) || !file_exists($path))
		{
			throw new Exception(JText::_('JLIB_APPLICATION_ERROR_COMPONENT_NOT_FOUND'), 404);
		}

		// Load common and local language files.
		$lang->load($option, JPATH_BASE, null, false, true) || $lang->load($option, JPATH_COMPONENT, null, false, true);

		// Handle template preview outlining.
		$contents = null;

		// Execute the component.
		$contents = static::executeComponent($path);

		// Revert the scope
		$app->scope = $scope;

		return $contents;
	}

	/**
	 * Execute the component.
	 *
	 * @param   string  $path  The component path.
	 *
	 * @return  string  The component output
	 *
	 * @since   1.7
	 */
	protected static function executeComponent($path)
	{
		ob_start();
		require_once $path;
		$contents = ob_get_clean();

		return $contents;
	}

	/**
	 * Load the installed components into the components property.
	 *
	 * @param   string  $option  The element value for the extension
	 *
	 * @return  boolean  True on success
	 *
	 * @since   1.5
	 * @deprecated  4.0  Use JComponentHelper::load() instead
	 */
	protected static function _load($option)
	{
		return static::load($option);
	}

	/**
	 * Load the installed components into the components property.
	 *
	 * @param   string  $option  The element value for the extension
	 *
	 * @return  boolean  True on success
	 *
	 * @since   3.2
	 */
	protected static function load($option)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('extension_id AS id, element AS "option", params, enabled')
			->from('#__extensions')
			->where($db->quoteName('type') . ' = ' . $db->quote('component'))
			->where($db->quoteName('element') . ' = ' . $db->quote($option));
		$db->setQuery($query);

		$cache = JFactory::getCache('_system', 'callback');

		try
		{
			static::$components[$option] = $cache->get(array($db, 'loadObject'), null, $option, false);
		}
		catch (RuntimeException $e)
		{
			// Fatal error.
			JLog::add(JText::sprintf('JLIB_APPLICATION_ERROR_COMPONENT_NOT_LOADING', $option, $e->getMessage()), JLog::WARNING, 'jerror');

			return false;
		}

		if (empty(static::$components[$option]))
		{
			return false;
		}

		// Convert the params to an object.
		if (is_string(static::$components[$option]->params))
		{
			$temp = new JRegistry;
			$temp->loadString(static::$components[$option]->params);
			static::$components[$option]->params = $temp;
		}

		return true;
	}
}
