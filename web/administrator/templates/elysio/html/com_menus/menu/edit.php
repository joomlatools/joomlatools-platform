<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_menus
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.core');
JHtml::_('behavior.formvalidator');

JText::script('ERROR');

JFactory::getDocument()->addScriptDeclaration("
		Joomla.submitbutton = function(task)
		{
			var form = document.getElementById('item-form');
			if (task == 'menu.cancel' || document.formvalidator.isValid(form))
			{
				Joomla.submitform(task, form);
			}
		};
");
?>
<form class="k-component k-js-component k-js-form-controller" action="<?php echo JRoute::_('index.php?option=com_menus&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form">

    <!-- Container -->
    <div class="k-container">
        <div class="k-container__main">
            <?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
        </div>
    </div>

    <div class="k-tabs-container">

		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_MENUS_MENU_DETAILS')); ?>

                <div class="k-container">
                    <div class="k-container__main">
                        <div class="k-form-group">
                            <?php echo $this->form->renderField('menutype'); ?>
                        </div>
                        <div class="k-form-group">
                            <?php echo $this->form->renderField('description'); ?>
                        </div>
                    </div>
                </div>

			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<?php if ($this->canDo->get('core.admin')) : ?>
				<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('COM_MENUS_FIELDSET_RULES')); ?>
                    <div class="k-container">
                        <div class="k-container__full">
					        <?php echo $this->form->getInput('rules'); ?>
                        </div>
                    </div>
				<?php echo JHtml::_('bootstrap.endTab'); ?>
			<?php endif; ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>

	</div>
</form>
