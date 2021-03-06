<?php
/**
 * @package    Joomla.Site
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

define('JPATH_WEB'   , __DIR__);
define('JPATH_ROOT'  , dirname(JPATH_WEB));
define('JPATH_BASE'  , JPATH_ROOT . '/app/site');
define('JPATH_CACHE' , JPATH_ROOT . '/cache/site');
define('JPATH_THEMES', __DIR__.'/templates');

require_once JPATH_ROOT . '/app/defines.php';
require_once JPATH_ROOT . '/app/bootstrap.php';

// Execute the application.
JFactory::getApplication('site')->execute();