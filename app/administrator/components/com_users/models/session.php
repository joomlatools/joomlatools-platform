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
 * Login Model
 *
 * @package     Joomla.Administrator
 * @subpackage  com_users
 * @since       1.5
 */
class UsersModelSession extends JModelLegacy
{
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication();

		$input = $app->input;
		$method = $input->getMethod();

		$credentials = array(
			'username' => $input->$method->get('username', '', 'USERNAME'),
			'password' => $input->$method->get('passwd', '', 'RAW'),
			'secretkey' => $input->$method->get('secretkey', '', 'RAW'),
		);
		$this->setState('credentials', $credentials);

		// Check for return URL from the request first
		if ($return = $input->$method->get('return', '', 'BASE64'))
		{
			$return = base64_decode($return);

			if (!JUri::isInternal($return))
			{
				$return = '';
			}
		}

		// Set the return URL if empty.
		if (empty($return))
		{
			$return = 'index.php';
		}

		$this->setState('return', $return);
	}
}
