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

<form class="k-form-layout k-form-flexbox" action="<?php echo JRoute::_('index.php?option=com_categories&extension=' . $input->getCmd('extension', 'com_content') . '&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form" class="form-validate">

    <!-- Container -->
    <div class="k-container">

        <!-- Main information -->
        <div class="k-container__main">
            <fieldset>
                <?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
            </fieldset>

            <div class="k-container__flex">
                <div class="tab-container">
                    <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

                    <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('Description', true)); ?>
                        <?php echo $this->form->getInput('description'); ?>
                    <?php echo JHtml::_('bootstrap.endTab'); ?>

                    <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('COM_CATEGORIES_FIELDSET_PUBLISHING', true)); ?>
                        <?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
                        <?php echo JLayoutHelper::render('joomla.edit.metadata', $this); ?>
                    <?php echo JHtml::_('bootstrap.endTab'); ?>

                    <?php if ($assoc) : ?>
                        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'associations', JText::_('JGLOBAL_FIELDSET_ASSOCIATIONS', true)); ?>
                        <?php echo $this->loadTemplate('associations'); ?>
                        <?php echo JHtml::_('bootstrap.endTab'); ?>
                    <?php endif; ?>

                    <?php if ($this->canDo->get('core.admin')) : ?>
                        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'rules', JText::_('COM_CATEGORIES_FIELDSET_RULES', true)); ?>
                        <?php echo $this->form->getInput('rules'); ?>
                        <?php echo JHtml::_('bootstrap.endTab'); ?>
                    <?php endif; ?>

                    <?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>

                    <?php echo JHtml::_('bootstrap.endTabSet'); ?>
                </div>
            </div><!-- .k-container__flex -->

        </div><!-- .k-container__main -->

        <!-- Other information -->
        <div class="k-container__sub">
            <fieldset class="k-form-block">
                <div class="k-form-block__header"><?php echo JText::_('DETAILS'); ?></div>
                <div class="k-form-block__content">
                    <?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
                </div>
            </fieldset>
        </div><!-- .k-container__sub -->

    </div><!-- .k-container -->

    <?php echo $this->form->getInput('extension'); ?>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
</form>
