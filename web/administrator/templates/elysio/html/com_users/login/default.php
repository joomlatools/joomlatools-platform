<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

$langs  = $this->langs;
$return = $this->return;

// Load chosen if we have language selector, ie, more than one administrator language installed and enabled.
if ($langs)
{
    JHtml::_('formbehavior.chosen', '.advancedSelect');
}
?>
<form action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="form-login">
    <fieldset>
        <div class="k-form-group">
            <label for="mod-login-username"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label>
            <input name="username" tabindex="1" id="mod-login-username" type="text" class="k-form-control" placeholder="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" size="15" autofocus="true" />
        </div>
        <div class="k-form-group">
            <label for="mod-login-password"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
            <input name="passwd" tabindex="2" id="mod-login-password" type="password" class="k-form-control" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" size="15"/>
        </div>
        <?php if (!empty($langs)) : ?>
            <div class="k-form-group">
                <label for="lang"><?php echo JText::_('COM_USERS_LOGIN_LANGUAGE'); ?></label>
                <?php echo $langs; ?>
            </div>
        <?php endif; ?>
        <div class="k-form-group">
            <button tabindex="3" class="k-button k-button--primary k-button--block">
                <span class="icon-lock icon-white"></span> <?php echo JText::_('COM_USERS_LOGIN_LOGIN'); ?>
            </button>
        </div>

    </fieldset>

    <input type="hidden" name="option" value="com_users"/>
    <input type="hidden" name="task" value="session.login"/>
    <input type="hidden" name="return" value="<?php echo $return; ?>"/>
    <?php echo JHtml::_('form.token'); ?>
</form>
