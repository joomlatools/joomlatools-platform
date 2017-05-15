<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');
JHtml::_('formbehavior.chosen');

?>
<form action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="form-login">
    <input type="hidden" name="option" value="com_users"/>
    <input type="hidden" name="task" value="session.login"/>
    <input type="hidden" name="return" value="<?php echo $return; ?>"/>
    <?php echo JHtml::_('form.token'); ?>
    <div class="k-form-group">
        <div class="k-input-group k-input-group--large">
            <span class="k-input-group__addon">
                <span class="k-icon-person" title="<?php echo JText::_('JGLOBAL_USERNAME'); ?>"></span>
                <label for="mod-login-username" class="k-visually-hidden">
                    <?php echo JText::_('JGLOBAL_USERNAME'); ?>
                </label>
            </span>
            <input name="username" tabindex="1" id="mod-login-username" type="text" class="k-form-control" placeholder="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" size="15"/>
        </div>
    </div>
    <div class="k-form-group">
        <div class="k-input-group k-input-group--large">
            <label for="mod-login-password" class="k-input-group__addon">
                <span class="k-icon-lock-locked" title="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>"></span>
                <span class="k-visually-hidden">
                    <?php echo JText::_('JGLOBAL_PASSWORD'); ?>
                </span>
            </label>
            <input name="passwd" tabindex="2" id="mod-login-password" type="password" class="k-form-control" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" size="15"/>
        </div>
    </div>
    <?php if (empty($langs)) : ?>
        <div class="k-form-group">
            <?php echo $langs; ?>
        </div>
    <?php endif; ?>
    <div class="k-form-group">
        <button tabindex="3" class="k-button k-button--primary k-button--large k-button--block">
            <?php echo JText::_('COM_USERS_LOGIN_LOGIN'); ?>
        </button>
    </div>
</form>
