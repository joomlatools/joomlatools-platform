<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * HTML View class for the Login component
 *
 * @since  1.6
 */
class UsersViewLogin extends JViewLegacy
{
    /**
     * Display the view
     */
    public function display($tpl = null)
    {
        $this->langs  = $this->getLanguageList();
        $this->return = $this->getReturnURI();

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

        usort(
            $languages,
            function ($a, $b)
            {
                return strcmp($a["value"], $b["value"]);
            }
        );

        // Fix wrongly set parentheses in RTL languages
        if (JFactory::getLanguage()->isRtl())
        {
            foreach ($languages as &$language)
            {
                $language['text'] = $language['text'] . '&#x200E;';
            }
        }

        array_unshift($languages, JHtml::_('select.option', '', JText::_('JDEFAULTLANGUAGE')));

        return JHtml::_('select.genericlist', $languages, 'lang', ' class="advancedSelect"', 'value', 'text', null);
    }

    /**
     * Get the redirect URI after login.
     *
     * @return  string
     */
    public static function getReturnUri()
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
