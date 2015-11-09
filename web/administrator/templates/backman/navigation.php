<!-- Top Navigation -->
<?php echo $this->params->get('templateColor') ?>
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
                <img src="<?php echo $this->baseurl; ?>/<?php echo $this->params->get('logo') ?>.svg" style="height: 30px;margin: -5px 0;">
            </a>
        </div>

        <?php if ($layout != 'error') : ?>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <jdoc:include type="modules" name="menu" style="none" />

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="k-icon-cog"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                                <span>
                                    <span class="k-icon-user"></span>
                                    <strong><?php echo $user->name; ?></strong>
                                </span>
                        </li>
                        <li>
                            <a href="index.php?option=com_users&amp;task=profile.edit&amp;id=<?php echo $user->id; ?>"><?php echo JText::_('TPL_ISIS_EDIT_ACCOUNT'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo JRoute::_('index.php?option=com_users&task=session.logout&' . JSession::getFormToken() . '=1'); ?>"><?php echo JText::_('TPL_ISIS_LOGOUT'); ?></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</nav>