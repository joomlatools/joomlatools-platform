<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  Component
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

use Joomla\Registry\Registry;

/**
 * Component helper class
 *
 * @since  1.5
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
	 * @return  stdClass   An object with the information for the component.
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
				$result->params = new Registry;
			}
		}
		else
		{
			$result = static::$components[$option];
		}

		if (is_string($result->params))
		{
			$temp = new Registry;
			$temp->loadString(static::$components[$option]->params);
			static::$components[$option]->params = $temp;
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
	 * Checks if a component is installed
	 *
	 * @param   string  $option  The component option.
	 *
	 * @return  integer
	 *
	 * @since   3.4
	 */
	public static function isInstalled($option)
	{
		$db = JFactory::getDbo();

		return (int) $db->setQuery(
			$db->getQuery(true)
				->select('COUNT(' . $db->quoteName('extension_id') . ')')
				->from($db->quoteName('#__extensions'))
				->where($db->quoteName('element') . ' = ' . $db->quote($option))
				->where($db->quoteName('type') . ' = ' . $db->quote('component'))
		)->loadResult();
	}

	/**
	 * Gets the parameter object for the component
	 *
	 * @param   string   $option  The option for the component.
	 * @param   boolean  $strict  If set and the component does not exist, false will be returned
	 *
	 * @return  Registry  A Registry object.
	 *
	 * @see     Registry
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
	 * @return  string
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

		if (JDEBUG)
		{
			JProfiler::getInstance('Application')->mark('beforeRenderComponent ' . $option);
		}

		// Record the scope
		$scope = $app->scope;

		// Set scope to component name
		$app->scope = $option;

		// Build the component path.
		$option = preg_replace('/[^A-Z0-9_\.-]/i', '', $option);
		$file = substr($option, 4);

		// Define component path.
		if (!defined('JPATH_COMPONENT'))
		{
			define('JPATH_COMPONENT', JPATH_BASE . '/components/' . $option);
		}

		if (!defined('JPATH_COMPONENT_SITE'))
		{
			define('JPATH_COMPONENT_SITE', JPATH_SITE . '/components/' . $option);
		}

		if (!defined('JPATH_COMPONENT_ADMINISTRATOR'))
		{
			define('JPATH_COMPONENT_ADMINISTRATOR', JPATH_ADMINISTRATOR . '/components/' . $option);
		}

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

		if (JDEBUG)
		{
			JProfiler::getInstance('Application')->mark('afterRenderComponent ' . $option);
		}

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
			->select($db->quoteName(array('extension_id', 'element', 'params', 'enabled'), array('id', 'option', null, null)))
			->from($db->quoteName('#__extensions'))
			->where($db->quoteName('type') . ' = ' . $db->quote('component'));
		$db->setQuery($query);

		$cache = JFactory::getCache('_system', 'callback');

		try
		{
			$components = $cache->get(array($db, 'loadObjectList'), array('option'), $option, false);

			/**
			 * Verify $components is an array, some cache handlers return an object even though
			 * the original was a single object array.
			 */
			if (!is_array($components))
			{
				static::$components[$option] = $components;
			}
			else
			{
				static::$components = $components;
			}
		}
		catch (RuntimeException $e)
		{
			/*
			 * Fatal error
			 *
			 * It is possible for this error to be reached before the global JLanguage instance has been loaded so we check for its presence
			 * before logging the error to ensure a human friendly message is always given
			 */

			if (JFactory::$language)
			{
				$msg = JText::sprintf('JLIB_APPLICATION_ERROR_COMPONENT_NOT_LOADING', $option, $e->getMessage());
			}
			else
			{
				$msg = sprintf('Error loading component: %1$s, %2$s', $option, $e->getMessage());
			}

			JLog::add($msg, JLog::WARNING, 'jerror');

			return false;
		}

		if (empty(static::$components[$option]))
		{
			return false;
		}

		return true;
	}

	/**
	 * Get installed components
	 *
	 * @return  array  The components property
	 *
	 * @since   3.6.3
	 */
	public static function getComponents()
	{
		if (empty(static::$components))
		{
			static::load('*');
		}

		return static::$components;
	}
}
