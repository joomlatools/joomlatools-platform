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
$lang = JFactory::getLanguage();

// Set MetaData
$doc->setCharset('utf8');
$doc->setGenerator($sitename);
$doc->setMetaData('viewport', 'width=device-width, initial-scale=1.0');
$doc->setMetaData('mobile-web-app-capable', 'yes');
$doc->setMetaData('apple-mobile-web-app-capable', 'yes');
$doc->setMetaData('apple-mobile-web-app-status-bar-style', 'black');
$doc->setMetaData('apple-mobile-web-app-title', 'Elysio');
$doc->setMetaData('X-UA-Compatible', 'IE=edge', true);

// Set links
$doc->addHeadLink($params->get('logo').'.ico', 'shortcut icon', 'rel', array('type' => 'image/ico'));
$doc->addHeadLink($params->get('logo').'.png', 'shortcut icon', 'rel', array('type' => 'image/png', "sizes" => "192x192"));

// Add Stylesheets
$doc->addStyleSheet('templates/' . $this->template . '/css/admin.css');

// Add Script
$doc->addScript('templates/'.$this->template.'/js/modernizr.js', 'text/javascript');
$doc->addScript('templates/'.$this->template.'/js/admin.js', 'text/javascript');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-title" content="Elysio" />
    <meta name="generator" content="Joomla Platform" />
    <title>Error</title>
    <link href="templates/elysio/images/favicon.ico" rel="shortcut icon" type="image/ico" />
    <link href="templates/elysio/images/favicon.png" rel="shortcut icon" type="image/png" />
    <link href="templates/elysio/images/xtouch-icon.png" rel="apple-touch-icon" type="image/png" />
    <link rel="stylesheet" href="templates/elysio/css/admin.css" type="text/css" />
    <script src="media/jui/js/jquery.js" type="text/javascript"></script>
    <script src="media/jui/js/jquery-noconflict.js" type="text/javascript"></script>
    <script src="media/jui/js/jquery-migrate.js" type="text/javascript"></script>
    <script src="templates/elysio/js/modernizr.js" type="text/javascript"></script>
    <script src="templates/elysio/js/admin.js" type="text/javascript"></script>
</head>

<body class="koowa admin <?php echo $option . ' view-' . $view . ' layout-' . $layout . ' task-' . $task . ' itemid-' . $itemid; ?> no-js">
<script src="templates/elysio/js/kui-initialize.js"></script>

<!-- Koowa -->
<div class="k-ui-namespace k-ui-container">

    <?php
    $layout = 'error';
    include_once('navigation.php');
    ?>

    <!-- Wrapper -->
    <div class="k-wrapper k-js-wrapper">

        <!-- Content wrapper -->
        <div class="k-content-wrapper">

            <!-- Content -->
            <div class="k-content">

                <!-- Component wrapper -->
                <div class="k-component-wrapper">

                    <!-- Component -->
                    <div class="k-component">

                        <!-- Container -->
                        <div class="k-container">

                            <div class="k-container__full">

                                <h1><?php echo JText::_('JERROR_AN_ERROR_HAS_OCCURRED'); ?></h1>

                                <blockquote>
                                    <span class="k-label k-label--info"><?php echo $this->code; ?></span>
                                    <?php echo htmlspecialchars($this->message, ENT_QUOTES, 'UTF-8');?>
                                </blockquote>

                                <p><a href="<?php echo $this->baseurl; ?>" class="k-button k-button--default"><?php echo JText::_('JGLOBAL_TPL_CPANEL_LINK_TEXT'); ?></a></p>

                            </div>

                        </div>

                    </div><!-- .k-component -->

                </div><!-- .k-component-wrapper -->

            </div><!-- k-content -->

        </div><!-- .k-content-wrapper -->

    </section><!-- .koowa-container -->

</div>

</body>

</html>
