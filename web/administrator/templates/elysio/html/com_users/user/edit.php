<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

JHtml::_('behavior.formvalidation');

// Get the form fieldsets.
$fieldsets = $this->form->getFieldsets();
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'user.cancel' || document.formvalidator.isValid(document.id('user-form')))
		{
			Joomla.submitform(task, document.getElementById('user-form'));
		}
	}
</script>

<!-- Form -->
<form class="k-form-layout" action="<?php echo JRoute::_('index.php?option=com_users&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="user-form" enctype="multipart/form-data">

    <!-- Container -->
    <div class="k-container">

        <div class="k-container__content">
            <? // Starting tabs ?>
            <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

                <? // Account details ?>
                <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_USERS_USER_ACCOUNT_DETAILS', true)); ?>

                <? // @TODO: add some fields to sub container ?>
                <!-- Main information -->
                <div class="k-container__main">
                    <?php foreach ($this->form->getFieldset('user_details') as $field) : ?>
                        <div class="control-group">
                            <div class="control-label">
                                <?php echo $field->label; ?>
                            </div>
                            <div class="controls">
                                <?php echo $field->input; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php echo JHtml::_('bootstrap.endTab'); ?>

                <? // Assigned user groups ?>
                <?php if ($this->grouplist) : ?>
                    <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'groups', JText::_('COM_USERS_ASSIGNED_GROUPS', true)); ?>
                    <?php echo $this->loadTemplate('groups'); ?>
                    <?php echo JHtml::_('bootstrap.endTab'); ?>
                <?php endif; ?>

                <? // Other tabs ?>
                <?php
                foreach ($fieldsets as $fieldset) :
                    if ($fieldset->name == 'user_details') :
                        continue;
                    endif;
                    ?>
                    <?php echo JHtml::_('bootstrap.addTab', 'myTab', $fieldset->name, JText::_($fieldset->label, true)); ?>
                    <?php foreach ($this->form->getFieldset($fieldset->name) as $field) : ?>
                    <?php if ($field->hidden) : ?>
                        <div class="control-group">
                            <div class="controls">
                                <?php echo $field->input; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="control-group">
                            <div class="control-label">
                                <?php echo $field->label; ?>
                            </div>
                            <div class="controls">
                                <?php echo $field->input; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                    <?php echo JHtml::_('bootstrap.endTab'); ?>
                <?php endforeach; ?>

            <? // Ending tabs ?>
            <?php echo JHtml::_('bootstrap.endTabSet'); ?>

            <input type="hidden" name="task" value="" />
            <?php echo JHtml::_('form.token'); ?>

        </div><!-- .k-container__content -->

    </div><!-- .k-container -->

</form><!-- .k-form-layout -->
