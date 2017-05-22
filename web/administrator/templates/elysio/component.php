<?php
/**
 * @package     elysio-template
 * @copyright   Copyright (C) 2015 Timble CVBA (http://www.timble.net)
 */

// No direct access
defined('_JEXEC') or die;

// Connect with Joomla
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$menu = $app->getMenu();

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

// Detecting Active Variables
$option = $app->input->getCmd('option', '');
$view = $app->input->getCmd('view', '');
$layout = $app->input->getCmd('layout', '');
$task = $app->input->getCmd('task', '');
$itemid = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');
$menuactive = $menu->getActive();
$debug = $app->getCfg('debug', 0);
$cpanel = ($option === 'com_cpanel');

// Set MetaData
$doc->setCharset('utf8');
$doc->setGenerator($sitename);
$doc->setMetaData('viewport', 'width=device-width, initial-scale=1.0');
$doc->setMetaData('mobile-web-app-capable', 'yes');
$doc->setMetaData('apple-mobile-web-app-capable', 'yes');
$doc->setMetaData('apple-mobile-web-app-status-bar-style', 'black');
$doc->setMetaData('apple-mobile-web-app-title', 'Elysio');
$doc->setMetaData('X-UA-Compatible', 'IE=edge', true);

// Unset Mootools
unset($this->_scripts['/joomlatools-platform/web/media/system/js/mootools-core-uncompressed.js']);
unset($this->_scripts['/joomlatools-platform/web/media/system/js/mootools-more-uncompressed.js']);

// Add Stylesheet
$doc->addStyleSheet('templates/' . $this->template . '/css/admin.css');

// Add Modernizr
$doc->addScript('templates/'.$this->template.'/js/modernizr.js', 'text/javascript');

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

// Add KUI scripts
$doc->addScript('templates/'.$this->template.'/js/koowa.kquery.js', 'text/javascript');
$doc->addScript('templates/'.$this->template.'/js/admin.js', 'text/javascript');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />
</head>
<body class="contentpane component">
    <div class="k-ui-namespace k-ui-container" style="overflow: auto;">
		<jdoc:include type="message" />
		<jdoc:include type="component" />
	</div>
</body>
</html>
