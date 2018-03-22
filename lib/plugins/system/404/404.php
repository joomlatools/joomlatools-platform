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
            $subpath     = preg_replace('#'.preg_quote(JURI::base(true)).'#', '', $menu_prefix, 1);
            $path        = JUri::base() . ltrim($subpath, '/');
            $path        = '/'. ltrim(preg_replace('#'.preg_quote($path).'#', '', JUri::current(), 1), '/');

            $regex   = '/\/[\d]+\-/';

            // Match url having "/xxx-" format, where xxx is a number.
            if (preg_match($regex, $path))
            {
                // Redirect with-id to no-id url
                $redirect = preg_replace($regex, '/', $path);
                $redirect = '/' . ltrim($menu_prefix . $redirect, '/');

                $app->redirect($redirect);
            }
        }

        JErrorPage::render($error);
    }
}
