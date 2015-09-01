<?php
/**
 * @package    Joomla.Administrator
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @copyright  Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Joomla system checks.
@ini_set('magic_quotes_runtime', 0);

// Installation check, and check on removal of the install directory.
if (!file_exists(JPATH_CONFIGURATION . '/configuration.php') || (filesize(JPATH_CONFIGURATION . '/configuration.php') < 10))
{
    echo 'No configuration file found and no installation code available. Exiting...';
	exit;
}

// System includes
require_once JPATH_LIBRARIES . '/import.legacy.php';

// Set system error handling
JError::setErrorHandling(E_NOTICE, 'message');
JError::setErrorHandling(E_WARNING, 'message');
JError::setErrorHandling(E_ERROR, 'message', array('JError', 'customErrorPage'));

// Bootstrap the CMS libraries.
require_once JPATH_LIBRARIES . '/cms.php';

// Pre-Load configuration. Don't remove the Output Buffering due to BOM issues, see JCode 26026
ob_start();
require_once JPATH_CONFIGURATION . '/configuration.php';
ob_end_clean();

// System configuration.
$config = new JConfig;

define('JDEBUG', $config->debug);

// System profiler
if ($config->debug) {
    JProfiler::getInstance('Application')->mark('afterLoad');
}

unset($config);
