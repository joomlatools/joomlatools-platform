<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', 'select');

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'user.cancel' || document.formvalidator.isValid(document.getElementById('user-form')))
		{
			Joomla.submitform(task, document.getElementById('user-form'));
		}
	};
");

// Get the form fieldsets.
$fieldsets = $this->form->getFieldsets();
?>

<form action="<?php echo JRoute::_('index.php?option=com_users&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="user-form" class="form-validate form-horizontal" enctype="multipart/form-data">

	<?php echo JLayoutHelper::render('joomla.edit.item_title', $this); ?>

	<fieldset>
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_USERS_USER_ACCOUNT_DETAILS')); ?>
				<?php foreach ($this->form->getFieldset('user_details') as $field) : ?>
					<div class="control-group">
						<div class="control-label">
							<?php echo $field->label; ?>
						</div>
						<div class="controls">
							<?php if ($field->fieldname == 'password') : ?>
								<?php // Disables autocomplete ?> <input type="password" style="display:none">
							<?php endif; ?>
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<?php if ($this->grouplist) : ?>
				<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'groups', JText::_('COM_USERS_ASSIGNED_GROUPS')); ?>
					<?php echo $this->loadTemplate('groups'); ?>
				<?php echo JHtml::_('bootstrap.endTab'); ?>
			<?php endif; ?>

			<?php
			$this->ignore_fieldsets = array('user_details');
			echo JLayoutHelper::render('joomla.edit.params', $this);
			?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
	</fieldset>

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
