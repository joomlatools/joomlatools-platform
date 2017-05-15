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

// Set links
$doc->addHeadLink($params->get('logo').'.ico', 'shortcut icon', 'rel', array('type' => 'image/ico'));
$doc->addHeadLink($params->get('logo').'.png', 'shortcut icon', 'rel', array('type' => 'image/png', "sizes" => "192x192"));

// Add Stylesheets
$doc->addStyleSheet('templates/' . $this->template . '/css/admin.css');

// Add Script
$doc->addScript('templates/'.$this->template.'/js/modernizr.js', 'text/javascript');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head" />
</head>

<body class="no-js">
<script type="text/javascript">function hasClass(e,t){return e.className.match(new RegExp("(\\s|^)"+t+"(\\s|$)"))}var el=document.body;var cl="no-js";if(hasClass(el,cl)){var reg=new RegExp("(\\s|^)"+cl+"(\\s|$)");el.className=el.className.replace(reg," k-js-enabled")}</script>

<!-- Koowa -->
<div class="k-ui-namespace k-ui-container">

    <!-- Wrapper -->
    <div class="k-wrapper k-js-wrapper">

        <!-- Login container -->
        <div class="k-login-container">

            <!-- Login -->
            <div class="k-login">

                <div class="k-login__brand">
                    <?php if ($params->get('logo')) : ?>
                        <img src="<?php echo $params->get('logo'); ?>" alt="<?php echo $sitename; ?>" />
                    <?php else: ?>
                        <img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/platform-logo.png" alt="<?php echo $sitename; ?>" />
                    <?php endif; ?>
                </div>

                <div class="k-login__content">
                    <jdoc:include type="message" />
                    <jdoc:include type="component" />
                </div>

            </div>

        </div><!-- .k-login-container -->

    </div><!-- .k-wrapper -->

</div>

<script type="text/javascript">
    // Autofocus on the login field
    jQuery(function($) {
        $( "#form-login input[name='username']" ).focus();
    });
</script>

</body>
</html>