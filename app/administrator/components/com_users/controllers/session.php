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
 * Login Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_users
 * @since       1.5
 */
class UsersControllerSession extends JControllerLegacy
{
	/**
	 * Method to log in a user.
	 *
	 * @return  void
	 */
	public function login()
	{
		$app = JFactory::getApplication();

		$model = $this->getModel('session');
		$credentials = $model->getState('credentials');
		$return = $model->getState('return');

		$result = $app->login($credentials, array('action' => 'core.login.admin'));

		if (!($result instanceof Exception))
		{
			$app->redirect($return);
		}

		parent::display();
	}

	/**
	 * Method to log out a user.
	 *
	 * @return  void
	 */
	public function logout()
	{
		JSession::checkToken('request') or jexit(JText::_('JInvalid_Token'));

		$app = JFactory::getApplication();

		$userid = $this->input->getInt('uid', null);

		$options = array(
			'clientid' => ($userid) ? 0 : 1
		);

		$result = $app->logout($userid, $options);

		if (!($result instanceof Exception))
		{
			$model 	= $this->getModel('session');
			$return = $model->getState('return');
			$app->redirect($return);
		}

		parent::display();
	}
}
