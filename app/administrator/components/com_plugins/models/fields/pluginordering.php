<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_plugins
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

/**
 * Supports an HTML select list of plugins
 *
 * @package     Joomla.Administrator
 * @subpackage  com_plugins
 * @since       1.6
 */
class JFormFieldPluginordering extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since   1.6
	 */
	protected $type = 'Pluginordering';

	/**
	 * Builds the query for the ordering list.
	 *
	 * @return  JDatabaseQuery  The query for the ordering form field
	 */
	protected function getQuery()
	{
		$db = JFactory::getDbo();
		$folder	= $this->form->getValue('folder');

		// Build the query for the ordering list.
		$query = $db->getQuery(true)
			->select(array($db->quoteName('ordering', 'value'), $db->quoteName('name', 'text'), $db->quoteName('type'), $db->quote('folder'), $db->quote('extension_id')))
			->from($db->quoteName('#__extensions'))
			->where('(type =' . $db->quote('plugin') . 'AND folder=' . $db->quote($folder) . ')')
			->order('ordering');

		return $query;
	}

    /**
     * Method to get the field input markup.
     *
     * @return  string	The field input markup.
     *
     * @since   3.2
     */
    protected function getInput()
    {
        $html = array();
        $attr = '';
        // Initialize some field attributes.
        $attr .= !empty($this->class) ? ' class="' . $this->class . '"' : '';
        $attr .= $this->disabled ? ' disabled' : '';
        $attr .= !empty($this->size) ? ' size="' . $this->size . '"' : '';
        // Initialize JavaScript field attributes.
        $attr .= !empty($this->onchange) ? ' onchange="' . $this->onchange . '"' : '';
        $itemId = (int) $this->getItemId();
        $query = $this->getQuery();
        // Create a read-only list (no name) with a hidden input to store the value.
        if ($this->readonly)
        {
            $html[] = JHtml::_('list.ordering', '', $query, trim($attr), $this->value, $itemId ? 0 : 1);
            $html[] = '<input type="hidden" name="' . $this->name . '" value="' . $this->value . '"/>';
        }
        else
        {
            // Create a regular list.
            $html[] = JHtml::_('list.ordering', $this->name, $query, trim($attr), $this->value, $itemId ? 0 : 1);
        }
        return implode($html);
    }

	/**
	 * Retrieves the current Item's Id.
	 *
	 * @return  integer  The current item ID
	 */
	protected function getItemId()
	{
		return (int) $this->form->getValue('extension_id');
	}
}
