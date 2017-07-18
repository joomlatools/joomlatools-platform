<!-- Top Navigation -->
<?php

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

// Gets the FrontEnd Main page Uri
$frontEndUri = JUri::getInstance(JUri::root());
$frontEndUri->setScheme(((int) $app->get('force_ssl', 0) === 2) ? 'https' : 'http');
$mainPageUri = $frontEndUri->toString();

?>

<nav class="k-menu-container">

    <div class="k-menu-container__logo">
        <a href="<?php echo $this->baseurl; ?>">
            <?php if ($params->get('logo')) : ?>
                <img src="<?php echo $params->get('avatar'); ?>" alt="<?php echo $sitename; ?>" />
            <?php else: ?>
                <img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/platform-avatar.png" alt="<?php echo $sitename; ?>" />
            <?php endif; ?>
        </a>
    </div>

    <?php if ($layout != 'error') : ?>
    <div class="k-menu-container__nav" id="navigation">

        <jdoc:include type="modules" name="menu" style="none" />

        <ul class="k-menu-right">
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
                    <span class="caret"></span>
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

    <!-- The toggle button for the left menu / area -->
    <button type="button" id="navigation-toggle" class="navigation-toggle" title="Navigation toggle" aria-label="Navigation toggle">
        <?php echo JText::_('TPL_ELYSIO_MENU'); ?>
    </button>
</nav>

<script>

    // Initiate responsive menu
    kQuery(document).ready(function ($) {

        // Remove stuff set by Joomla core which we can't override
        $('.k-menu-container .dropdown').removeAttr('class');
        $('.k-menu-container .dropdown-menu').removeAttr('class');
        $('.k-menu-container .dropdown-toggle').removeAttr('class').removeAttr('data-toggle');
        $('.k-menu-container #nav-empty').remove();

        // Variables
        var $navigation = $('#navigation'),
            $navigationItem = $('#navigation > ul > li > a'),
            menuClass = 'has-open.menu',
            submenuClass = 'has-open-submenu';

        // Off canvas
        $navigation.offCanvasMenu({
            menuToggle: $('#navigation-toggle'),
            position: 'right',
            container: $('.k-wrapper'),
            expandedWidth: '276',
            wrapper: $('.k-ui-container')
        });

        // Click a menu item
        function clickMenuItem($element) {
            $element.on('click', function(event) {
                event.preventDefault();
                if ( $navigation.hasClass(menuClass) && $(this).hasClass(submenuClass) ) {
                    closeMenu();
                } else {
                    openMenuItem($(this));
                }
            });
        }

        // Open a menu item
        function openMenuItem($element) {
            if ( $navigation.hasClass(menuClass) && $(this).hasClass(submenuClass) ) {
                closeMenu();
            } else {
                $('.' + submenuClass).removeClass(submenuClass);
                $element.addClass(submenuClass);
                $navigation.addClass(menuClass);
            }
        }

        // Hover a menu item
        function hoverMenuItem() {
            $navigationItem.on('mouseover', function(event) {
                // Only on desktop
                if ( $('.k-menu-container').css('z-index') == 3 ) {
                    event.preventDefault();
                    if ( $navigation.hasClass(menuClass) ) {
                        openMenuItem($(this));
                    }
                }
            });
        }

        // Close all items
        function closeMenu() {
            $navigation.removeClass(menuClass).find('.' + submenuClass).removeClass(submenuClass);
        }

        // Initiate
        clickMenuItem($navigationItem);
        hoverMenuItem();

        // On clicking next to the menu
        $(document).mouseup(function(e) {
            var $navigationList = $('.k-menu-container__nav > ul');

            // if the target of the click isn't the container nor a descendant of the container
            if (!$navigationList.is(e.target) && $navigationList.has(e.target).length === 0)
            {
                closeMenu();
            }
        });

        // On ESC key
        $(document).keyup(function(e) {
            if (e.keyCode === 27) {
                closeMenu();
            }
        });
    });


</script>