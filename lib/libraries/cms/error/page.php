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
	 * @param   object  $error  An Exception or Throwable (PHP 7+) object for which to render the error page.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public static function render($error)
	{
		$expectedClass = PHP_MAJOR_VERSION >= 7 ? 'Throwable' : 'Exception';
		$isException   = $error instanceof $expectedClass;

		// In PHP 5, the $error object should be an instance of Exception; PHP 7 should be a Throwable implementation
		if ($isException)
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

				if (!$document || PHP_SAPI == 'cli')
				{
					// We're probably in an CLI environment
					jexit($message);
				}

				// Get the current template from the application
				$template = $app->getTemplate();

				// Push the error object into the document
				$document->setError($error);

				if (ob_get_contents()) {
					ob_end_clean();
				}

				$document->setTitle(JText::_('Error') . ': ' . $code);
				$data = $document->render(
					false,
					array(
						'template'  => $template,
						'directory' => JPATH_THEMES,
						'debug'     => JFactory::getConfig()->get('debug')
					)
				);

				// Do not allow cache
				$app->allowCache(false);

				// If nothing was rendered, just use the message from the Exception
				if (empty($data))
				{
					$data = $message;
				}

				$app->setBody($data);

				echo $app->toString();

				return;
			}
			catch (Exception $e)
			{
				// Pass the error down
			}
		}

		// This isn't an Exception, we can't handle it.
		if (!headers_sent())
		{
			header('HTTP/1.1 500 Internal Server Error');
		}

		$message = 'Error displaying the error page';

		if ($isException)
		{
			$message .= ': ' . $e->getMessage() . ': ' . $message;
		}

		echo $message;

		jexit(1);
	}
}
