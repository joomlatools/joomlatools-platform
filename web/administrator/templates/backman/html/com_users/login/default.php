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
    <div class="form-group">
        <div class="input-group input-group-lg">
            <span class="input-group-addon">
                <span class="k-icon-person" title="<?php echo JText::_('JGLOBAL_USERNAME'); ?>"></span>
                <label for="mod-login-username" class="element-invisible">
                    <?php echo JText::_('JGLOBAL_USERNAME'); ?>
                </label>
            </span>
            <input name="username" tabindex="1" id="mod-login-username" type="text" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" size="15"/>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group input-group-lg">
            <label for="mod-login-password" class="input-group-addon">
                <span class="k-icon-lock-locked" title="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>"></span>
                <span class="element-invisible">
                    <?php echo JText::_('JGLOBAL_PASSWORD'); ?>
                </span>
            </label>
            <input name="passwd" tabindex="2" id="mod-login-password" type="password" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" size="15"/>
        </div>
    </div>
    <?php if (!empty($langs)) : ?>
        <div class="form-group">
            <?php echo $langs; ?>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <button tabindex="3" class="btn btn-primary btn-lg btn-block">
            <?php echo JText::_('COM_USERS_LOGIN_LOGIN'); ?>
        </button>
    </div>
</form>
