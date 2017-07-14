<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @deprecated  3.4 Use default_batch_body and default_batch_footer
 */

defined('_JEXEC') or die;

// Create the copy/move options.
$options = array(
	JHtml::_('select.option', 'add', JText::_('COM_USERS_BATCH_ADD')),
	JHtml::_('select.option', 'del', JText::_('COM_USERS_BATCH_DELETE')),
	JHtml::_('select.option', 'set', JText::_('COM_USERS_BATCH_SET'))
);

// Create the reset password options.
$resetOptions = array(
	JHtml::_('select.option', '', JText::_('COM_USERS_NO_ACTION')),
	JHtml::_('select.option', 'yes', JText::_('JYES')),
	JHtml::_('select.option', 'no', JText::_('JNO'))
);
?>
<div class="modal hide fade" id="collapseModal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&#215;</button>
		<h3 class="k-heading"><?php echo JText::_('COM_USERS_BATCH_OPTIONS'); ?></h3>
	</div>
	<div class="modal-body modal-batch">
        <div id="batch-choose-action" class="k-form-group combo">
            <label id="batch-choose-action-lbl" for="batch-choose-action">
                <?php echo JText::_('COM_USERS_BATCH_GROUP') ?>
            </label>
        </div>
        <div id="batch-choose-action" class="combo">
            <div class="k-form-group">
                <select name="batch[group_id]" id="batch-group-id">
                    <option value=""><?php echo JText::_('JSELECT') ?></option>
                    <?php echo JHtml::_('select.options', JHtml::_('user.groups')); ?>
                </select>
            </div>
        </div>
        <div class="k-form-group radio">
            <?php echo JHtml::_('select.radiolist', $options, 'batch[group_action]', '', 'value', 'text', 'add') ?>
        </div>
		<label><?php echo JText::_('COM_USERS_REQUIRE_PASSWORD_RESET'); ?></label>
		<div class="k-form-group radio">
			<?php echo JHtml::_('select.radiolist', $resetOptions, 'batch[reset_id]', '', 'value', 'text', '') ?>
		</div>
	</div>
	<div class="modal-footer">
		<button class="k-button k-button--defaul" type="button" onclick="document.getElementById('batch-group-id').value=''" data-dismiss="modal">
			<?php echo JText::_('JCANCEL'); ?>
		</button>
		<button class="k-button k-button--primary" type="submit" onclick="Joomla.submitbutton('user.batch');">
			<?php echo JText::_('JGLOBAL_BATCH_PROCESS'); ?>
		</button>
	</div>
</div>
