<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Overrides
include_once(JPATH_WEB.'/administrator/templates/elysio/html/overrides.php');

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.formvalidator');

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

<!-- Form -->
<form class="k-component k-js-component k-js-form-controller" action="<?php echo JRoute::_('index.php?option=com_users&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="user-form" enctype="multipart/form-data">

    <div class="k-tabs-container">

        <? // Starting tabs ?>
        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_USERS_USER_ACCOUNT_DETAILS', true)); ?>

        <div class="k-container">

            <!-- Main information -->
            <div class="k-container__main">

                <?php foreach ($this->form->getFieldset('user_details') as $field) : ?>
                    <div class="k-container__main">
                        <div class="k-form-group">
                            <?php echo $field->label; ?>
                            <div class="controls">
                                <?php if ($field->fieldname == 'password') : ?>
                                    <?php // Disables autocomplete ?> <input type="password" style="display:none">
                                <?php endif; ?>
                                <?php echo addFormControlClass($field->input); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

        </div>

        <?php echo JHtml::_('bootstrap.endTab'); ?>

            <?php if ($this->grouplist) : ?>
                <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'groups', JText::_('COM_USERS_ASSIGNED_GROUPS')); ?>
                <div class="k-container">
                    <div class="k-container__main">
                        <?php echo $this->loadTemplate('groups'); ?>
                    </div>
                </div>
                <?php echo JHtml::_('bootstrap.endTab'); ?>
            <?php endif; ?>

            <?php
            $this->ignore_fieldsets = array('user_details');
            echo JLayoutHelper::render('joomla.edit.params', $this);
            ?>

        <?php echo JHtml::_('bootstrap.endTabSet'); ?>

        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>

    </div>

</form><!-- .k-form-layout -->