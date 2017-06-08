<!-- Top Navigation -->
<?php

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

// Gets the FrontEnd Main page Uri
$frontEndUri = JUri::getInstance(JUri::root());
$frontEndUri->setScheme(((int) $app->get('force_ssl', 0) === 2) ? 'https' : 'http');
$mainPageUri = $frontEndUri->toString();

?>

<nav class="k-navigation-container navbar navbar-default navbar-static-top">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $this->baseurl; ?>">
                <?php if ($params->get('logo')) : ?>
                    <img src="<?php echo $params->get('avatar'); ?>" alt="<?php echo $sitename; ?>" />
                <?php else: ?>
                    <img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/platform-avatar.png" alt="<?php echo $sitename; ?>" />
                <?php endif; ?>
            </a>
        </div>

        <?php if ($layout != 'error') : ?>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <jdoc:include type="modules" name="menu" style="none" />

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="brand hidden-desktop hidden-tablet" href="<?php echo $mainPageUri; ?>" title="<?php echo JText::sprintf('TPL_ISIS_PREVIEW', $sitename); ?>" target="_blank">
                        <span style="margin-right: 5px">View site</span>
                        <span class="k-icon-external-link" aria-hidden="true"></span>
                    </a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="k-icon-person" aria-hidden="true"></span>
                        <span class="k-visually-hidden">Settings</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="index.php?option=com_users&amp;task=profile.edit&amp;id=<?php echo $user->id; ?>"><?php echo JText::_('TPL_ELYSIO_EDIT_ACCOUNT'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo JRoute::_('index.php?option=com_users&task=session.logout&' . JSession::getFormToken() . '=1'); ?>"><?php echo JText::_('TPL_ELYSIO_LOGOUT'); ?></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</nav>