<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_categories
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');

$app = JFactory::getApplication();
$input = $app->input;

$assoc = JLanguageAssociations::isEnabled();
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'category.cancel' || document.formvalidator.isValid(document.id('item-form')))
		{
			<?php echo $this->form->getField('description')->save(); ?>
			Joomla.submitform(task, document.getElementById('item-form'));
		}
	}
</script>

<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_categories&extension=' . $input->getCmd('extension', 'com_content') . '&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form">

    <!-- Container -->
    <div class="k-container">
        <div class="k-container__main">
            <?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
        </div>
    </div>

    <div class="k-tabs-container">

		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('JCATEGORY', true)); ?>
        <div class="k-container k-flexbox-from-charlie k-flex-grow">
            <div class="k-container__main k-flexbox-from-charlie k-do-flex k-flexbox-column">
                <div class="mceditor-container">
                    <?php echo $this->form->getInput('description'); ?>
                </div>
            </div>
            <div class="k-container__sub k-overflow">
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
            </div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('COM_CATEGORIES_FIELDSET_PUBLISHING', true)); ?>
        <div class="k-container">
            <div class="k-container__main">
				<?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
            </div>
            <div class="k-container__sub">
				<?php echo JLayoutHelper::render('joomla.edit.metadata', $this); ?>
            </div>
        </div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php if ($assoc) : ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'associations', JText::_('JGLOBAL_FIELDSET_ASSOCIATIONS', true)); ?>
            <div class="k-container">
                <div class="k-container__full">
			        <?php echo $this->loadTemplate('associations'); ?>
                </div>
            </div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php endif; ?>

		<?php if ($this->canDo->get('core.admin')) : ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'rules', JText::_('COM_CATEGORIES_FIELDSET_RULES', true)); ?>
            <div class="k-container">
                <div class="k-container__full">
                    <?php echo $this->form->getInput('rules'); ?>
                </div>
            </div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php endif; ?>

		<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

		<?php echo $this->form->getInput('extension'); ?>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>

    </div><!-- .k-tabs-container -->

</form><!-- .k-component -->
