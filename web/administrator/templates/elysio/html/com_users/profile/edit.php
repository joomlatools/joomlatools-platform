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

JFactory::getDocument()->addScriptDeclaration('
	Joomla.submitbutton = function(task)
	{
		if (task == "profile.cancel" || document.formvalidator.isValid(document.getElementById("profile-form")))
		{
			Joomla.submitform(task, document.getElementById("profile-form"));
		}
	};
');

// Get the form fieldsets.
$fieldsets = $this->form->getFieldsets();
?>

<!-- Component -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_users&view=profile&layout=edit&id=' . $this->item->id); ?>" method="post" name="adminForm" id="profile-form" enctype="multipart/form-data">

    <!-- Tabs container -->
    <div class="k-tabs-container">

        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'account')); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'account', JText::_('COM_USERS_USER_ACCOUNT_DETAILS')); ?>
        <div class="k-container">
            <div class="k-container__main">
                <?php foreach ($this->form->getFieldset('user_details') as $field) : ?>
                    <div class="k-form-group">
                        <?php echo $field->label; ?>
                        <?php if ($field->fieldname == 'password2') : ?>
                            <?php // Disables autocomplete ?>
                            <input class="k-form-control" type="password" style="display:none">
                        <?php endif; ?>
                        <?php echo addFormControlClass($field->input); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php echo JHtml::_('bootstrap.endTab'); ?>

        <?php foreach ($fieldsets as $fieldset) : ?>
            <?php
            if ($fieldset->name == 'user_details')
            {
                continue;
            }
            ?>
            <?php echo JHtml::_('bootstrap.addTab', 'myTab', $fieldset->name, JText::_($fieldset->label)); ?>
                <div class="k-container">
                    <div class="k-container__main">
                    <?php foreach ($this->form->getFieldset($fieldset->name) as $field) : ?>
                        <?php if ($field->hidden) : ?>
                            <div class="k-form-group">
                                <?php echo $field->input; ?>
                            </div>
                        <?php else: ?>
                            <div class="k-form-group">
                                <?php echo $field->label; ?>
                                <?php echo $field->input; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </div>
                </div>
            <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php endforeach; ?>

        <?php echo JHtml::_('bootstrap.endTabSet'); ?>
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>

    </div><!-- .k-tabs-container -->

</form><!-- k.component -->
