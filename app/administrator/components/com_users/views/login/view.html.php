<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * HTML View class for the Login component
 *
 * @package     Joomla.Administrator
 * @subpackage  com_users
 * @since       1.6
 */
class UsersViewLogin extends JViewLegacy
{
    /**
     * Display the view
     */
    public function display($tpl = null)
    {
        $this->sidebar = $this->getLanguageList();
        $this->return  = $this->getReturnURI();

        parent::display($tpl);
    }

    /**
     * Get an HTML select list of the available languages.
     *
     * @return  string
     */
    public static function getLanguageList()
    {
        $languages = JLanguageHelper::createLanguageList(null, JPATH_ADMINISTRATOR, false, true);

        if (count($languages) <= 1)
        {
            return '';
        }

        array_unshift($languages, JHtml::_('select.option', '', JText::_('JDEFAULTLANGUAGE')));

        return JHtml::_('select.genericlist', $languages, 'lang', ' class="advancedSelect"', 'value', 'text', null);
    }

    /**
     * Get the redirect URI after login.
     *
     * @return  string
     */
    public static function getReturnURI()
    {
        $uri    = JUri::getInstance();
        $return = 'index.php' . $uri->toString(array('query'));

        if ($return != 'index.php?option=com_users')
        {
            return base64_encode($return);
        }
        else
        {
            return base64_encode('index.php');
        }
    }
}
