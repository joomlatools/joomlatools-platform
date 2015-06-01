<?php
/**
 * @package    Joomla.Administrator
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

define('_JEXEC', 1);

define('JPATH_WEB'   , dirname(__DIR__));
define('JPATH_ROOT'  , dirname(JPATH_WEB));
define('JPATH_BASE'  , JPATH_ROOT . '/app/administrator');
define('JPATH_CACHE' , JPATH_ROOT . '/cache/administrator');
define('JPATH_THEMES', __DIR__.'/templates');

require_once JPATH_ROOT . '/app/defines.php';
require_once JPATH_ROOT . '/app/bootstrap.php';

//Legacy requires
require_once JPATH_BASE . '/helper.php';
require_once JPATH_BASE . '/toolbar.php';

// Execute the application.
JFactory::getApplication('administrator')->execute();
