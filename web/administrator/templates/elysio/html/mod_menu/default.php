<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$user      = JFactory::getUser();
$lang      = JFactory::getLanguage();

$direction = JFactory::getDocument()->direction == 'rtl' ? 'pull-right' : '';
$shownew    = (boolean) $params->get('shownew', 1);

/*
 * Components Submenu
 */

$menu->addChild(new JMenuNode(JText::_('MOD_MENU_COMPONENTS'), '#', $enabled ? '' : 'disabled'), true);

// Get the authorised components and sub-menus.
$components = ModMenuHelper::getComponents(true);

// Check if there are any components, otherwise, don't render the menu
if($components && $enabled)
{
    foreach ($components as &$component)
    {
        if (!empty($component->submenu))
        {
            // This component has a db driven submenu.
            $menu->addChild(new JMenuNode($component->text, $component->link, $component->img), true);

            foreach ($component->submenu as $sub)
            {
                $menu->addChild(new JMenuNode($sub->text, $sub->link, $sub->img));
            }

            $menu->getParent();
        }
        else
        {
            $menu->addChild(new JMenuNode($component->text, $component->link, $component->img));
        }
    }
}

$menu->getParent();


/*
 * Menus Submenu
 */
if ($user->authorise('core.manage', 'com_menus'))
{
    $menu->addChild(new JMenuNode(JText::_('MOD_MENU_MENUS'), '#', $enabled ? '' : 'disabled'), true);
    $createMenu = $shownew && $user->authorise('core.create', 'com_menus');

    if($enabled)
    {
        $menu->addChild(new JMenuNode(JText::_('MOD_MENU_MENU_MANAGER'), 'index.php?option=com_menus&view=menus', 'class:menumgr'), $createMenu);

        $menu->getParent();

        $menu->addSeparator();

        // Menu Types
        foreach (ModMenuHelper::getMenus() as $menuType)
        {
            $alt = '*' . $menuType->sef . '*';

            if ($menuType->home == 0)
            {
                $titleicon = '';
            }
            elseif ($menuType->home == 1 && $menuType->language == '*')
            {
                $titleicon = ' <span class="k-icon-home" aria-hidden="true"></span>';
            }
            elseif ($menuType->home > 1)
            {
                $titleicon = ' <span>'
                    . JHtml::_('image', 'mod_languages/icon-16-language.png', $menuType->home, array('title' => JText::_('MOD_MENU_HOME_MULTIPLE')), true)
                    . '</span>';
            }
            else
            {
                $image = JHtml::_('image', 'mod_languages/' . $menuType->image . '.gif', null, null, true, true);

                if (!$image)
                {
                    $image = JHtml::_('image', 'mod_languages/icon-16-language.png', $alt, array('title' => $menuType->title_native), true);
                }
                else
                {
                    $image = JHtml::_('image', 'mod_languages/' . $menuType->image . '.gif', $alt, array('title' => $menuType->title_native), true);
                }

                $titleicon = ' <span>' . $image . '</span>';
            }

            $menu->addChild(
                new JMenuNode(
                    $menuType->title, 'index.php?option=com_menus&view=items&menutype=' . $menuType->menutype, 'class:menu', null, null, $titleicon
                ),
                $createMenu
            );

            $menu->getParent();
        }
    }

    $menu->getParent();
}

/*
 * Users Submenu
 */
if ($user->authorise('core.manage', 'com_users'))
{
    $menu->addChild(new JMenuNode(JText::_('MOD_MENU_COM_USERS_USERS'), '#', $enabled ? '' : 'disabled'), true);
    $createUser = $shownew && $user->authorise('core.create', 'com_users');
    $createGrp  = $user->authorise('core.admin', 'com_users');

    if($enabled)
    {
        $menu->addChild(new JMenuNode(JText::_('MOD_MENU_COM_USERS_USER_MANAGER'), 'index.php?option=com_users&view=users', 'class:user'), $createUser);
        $menu->getParent();


        if ($createGrp)
        {
            $menu->addChild(new JMenuNode(JText::_('MOD_MENU_COM_USERS_GROUPS'), 'index.php?option=com_users&view=groups', 'class:groups'), $createUser);
            $menu->getParent();

            $menu->addChild(new JMenuNode(JText::_('MOD_MENU_COM_USERS_LEVELS'), 'index.php?option=com_users&view=levels', 'class:levels'), $createUser);
            $menu->getParent();
        }
    }

    $menu->getParent();
}

/*
 * System Submenu
 */
$mm = $user->authorise('core.manage', 'com_modules');
$pm = $user->authorise('core.manage', 'com_plugins');
$tm = $user->authorise('core.manage', 'com_templates');
$lm = $user->authorise('core.manage', 'com_languages');

$menu->addChild(new JMenuNode(JText::_('MOD_MENU_SYSTEM'), '#', $enabled ? '' : 'disabled'), true);

if($enabled)
{
    if ($enabled && $user->authorise('core.admin'))
    {
        $menu->addChild(new JMenuNode(JText::_('MOD_MENU_CONFIGURATION'), 'index.php?option=com_config', 'class:config'));
        $menu->addSeparator();
    }

    /*
     * Extensions Submenu
     */

    if ($mm || $pm || $tm || $lm)
    {
        if ($mm)
        {
            $menu->addChild(new JMenuNode(JText::_('MOD_MENU_EXTENSIONS_MODULE_MANAGER'), 'index.php?option=com_modules', 'class:module'));
        }

        if ($pm)
        {
            $menu->addChild(new JMenuNode(JText::_('MOD_MENU_EXTENSIONS_PLUGIN_MANAGER'), 'index.php?option=com_plugins', 'class:plugin'));
        }

        if ($tm)
        {
            $menu->addChild(new JMenuNode(JText::_('MOD_MENU_EXTENSIONS_TEMPLATE_MANAGER'), 'index.php?option=com_templates', 'class:themes'));
        }

        if ($lm)
        {
            $menu->addChild(new JMenuNode(JText::_('MOD_MENU_EXTENSIONS_LANGUAGE_MANAGER'), 'index.php?option=com_languages', 'class:language'));
        }
    }

}

$menu->getParent();

$menu->renderMenu('menu', $enabled ? '' . $direction : 'disabled ' . $direction);
