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
		if (task == 'level.cancel' || document.formvalidator.isValid(document.getElementById('level-form')))
		{
			Joomla.submitform(task, document.getElementById('level-form'));
		}
	};
");
?>

<!-- Component -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_users&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="level-form">

    <!-- Container -->
    <div class="k-container">

        <div class="k-container__main">
            <div class="k-form-group k-form-group--large">
                <?php echo $this->form->getLabel('title'); ?>
                <?php echo addFormControlClass($this->form->getInput('title')); ?>
            </div>
            <fieldset>
                <legend><?php echo JText::_('COM_USERS_USER_GROUPS_HAVING_ACCESS');?></legend>
                <?php echo JHtml::_('access.usergroups', 'jform[rules]', $this->item->rules); ?>
            </fieldset>
            <input type="hidden" name="task" value="" />
            <?php echo JHtml::_('form.token'); ?>
        </div>

    </div><!-- .k-container -->

</form><!-- .k-component -->
