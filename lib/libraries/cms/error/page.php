<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  Error
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

/**
 * Displays the custom error page when an uncaught exception occurs.
 *
 * @package     Joomla.Libraries
 * @subpackage  Error
 * @since       3.0
 */
class JErrorPage
{
	/**
	 * Render the error page based on an exception.
	 *
	 * @param   Exception  $error  The exception for which to render the error page.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public static function render(Exception $error)
	{
		try
		{
			$app      = JFactory::getApplication();
			$document = JDocument::getInstance('error');

            $code = $error->getCode();
            if(!isset(JHttpResponse::$status_messages[$code])) {
                $code = '500';
            }

            if(ini_get('display_errors')) {
                $message = $error->getMessage();
            } else {
                $message = JHttpResponse::$status_messages[$code];
            }

            // Exit immediatly if we are in a CLI environment
			if (!$document || PHP_SAPI == 'cli')
			{
				exit($message);
				$app->close(0);
			}

			$config = JFactory::getConfig();

			// Get the current template from the application
			$template = $app->getTemplate();

			$document->setError($error);

			if (ob_get_contents()) {
				ob_end_clean();
			}

			$document->setTitle(JText::_('Error') . ': ' . $code);
			$data = $document->render(
				false,
				array('template' => $template,
				'directory' => JPATH_THEMES,
				'debug' => $config->get('debug'))
			);

			// Failsafe to get the error displayed.
			if (!empty($data))
			{
                // Do not allow cache
                $app->allowCache(false);

                $app->setBody($data);
                echo $app->toString();
			}
			else
            {
                exit($message);
            }
		}
		catch (Exception $e)
        {
            exit('Error displaying the error page: ' . $e->getMessage() . ': ' . $message);
		}
	}
}
