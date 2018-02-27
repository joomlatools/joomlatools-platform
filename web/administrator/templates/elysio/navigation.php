<!-- Top Navigation -->
<?php

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

// Gets the FrontEnd Main page Uri
$frontEndUri = JUri::getInstance(JUri::root());
$frontEndUri->setScheme(((int) $app->get('force_ssl', 0) === 2) ? 'https' : 'http');
$mainPageUri = $frontEndUri->toString();

?>

<nav class="k-top-container">

    <div class="k-top-container__logo">
        <a href="<?php echo $this->baseurl; ?>">
            <?php if ($params->get('logo')) : ?>
                <img src="<?php echo $params->get('avatar'); ?>" alt="<?php echo $sitename; ?>" />
            <?php else: ?>
                <img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/platform-avatar.png" alt="<?php echo $sitename; ?>" />
            <?php endif; ?>
        </a>
    </div>

    <?php if ($layout != 'error') : ?>
    <div class="k-top-container__navigation k-js-top-navigation" id="k-js-menu">

        <jdoc:include type="modules" name="menu" style="none" />

        <ul class="k-navigation-right">
            <li>
                <a href="<?php echo $mainPageUri; ?>" title="<?php echo JText::sprintf('TPL_ISIS_PREVIEW', $sitename); ?>" target="_blank">
                    <span style="margin-right: 5px">View site</span>
                    <span class="k-icon-external-link" aria-hidden="true"></span>
                </a>
            </li>
            <li>
                <a data-toggle="dropdown" href="#">
                    <span class="k-icon-person" aria-hidden="true"></span>
                    <span class="k-visually-hidden">Settings</span>
                </a>
                <ul>
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
</nav>
