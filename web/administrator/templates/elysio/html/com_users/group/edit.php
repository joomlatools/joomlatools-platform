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

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'group.cancel' || document.formvalidator.isValid(document.getElementById('group-form')))
		{
			Joomla.submitform(task, document.getElementById('group-form'));
		}
	};
");
?>

<!-- Form -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_users&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="group-form">

	<!-- Container -->
	<div class="k-container">

        <!-- Main information -->
        <div class="k-container__main">

            <div class="form-group">
                <?php echo $this->form->getLabel('title'); ?>
                <?php echo $this->form->getInput('title'); ?>
            </div>

            <div class="form-group">
                <?php $parent_id = $this->form->getField('parent_id');?>
                <?php if (!$parent_id->hidden) : ?>
                    <?php echo $parent_id->label; ?>
                <?php endif;?>
                <?php echo $parent_id->input; ?>
            </div>

            <input type="hidden" name="task" value="" />
            <?php echo JHtml::_('form.token'); ?>

        </div><!-- .k-container__content -->

	</div><!-- .k-container -->

</form><!-- .k-component -->
