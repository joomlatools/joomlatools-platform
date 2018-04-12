<?php
/**
 * @package     System - 404
 * @copyright   Copyright (C) 2018 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.joomlatools.com
 */

defined('_JEXEC') or die;

class PlgSystem404 extends JPlugin
{
    public function __construct(&$subject, $config)
    {
        parent::__construct($subject, $config);

        if (JFactory::getApplication()->isSite())
        {
            // Set the JError handler for E_ERROR to be the class' handleError method.
            JError::setErrorHandling(E_ERROR, 'callback', array('PlgSystem404', 'handleError'));
        }
    }

    public static function handleError(JException $error)
    {
        $app = JFactory::getApplication();

        if ($app->get('sef') && (int) $error->getCode() == 404)
        {
            $menu        = $app->getMenu()->getActive();
            $menu_prefix = JRoute::_($menu->link, false);
            $subpath     = $menu_prefix;

            if ($base = JURI::base(true)) {
                $subpath = preg_replace('#^'.preg_quote($base).'#', '', $menu_prefix, 1);
            }

            $path = JUri::base() . ltrim($subpath, '/');
            $path = ltrim(preg_replace('#^'.preg_quote($path).'#', '', JUri::current(), 1), '/');

            $redirect = false;
            // category redirect, redirect to path-without-leading-id
            if (preg_match('#^([0-9]+)\-(.+)$#i', $path, $matches)) {
                $redirect = $matches[2];
            }
            // article redirect, redirect to path-until-article/article-alias-without-id
            elseif (preg_match('#(.*\/)+([0-9]+)\-(.+)$#i', $path, $matches))
            {
                $redirect = $matches[1] . $matches[3];
            }

            if ($redirect)
            {
                $redirect = $menu_prefix . '/' . $redirect;
                $app->redirect($redirect);
            }
        }

        JErrorPage::render($error);
    }
}
