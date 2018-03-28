<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_tags
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

// Create shortcut to parameters.
$params = $this->state->get('params');
$params = $params->toArray();
?>

<!-- Form -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_tags&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form">

    <!-- Container -->
    <div class="k-container">
        <div class="k-container__main">
            <?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
        </div>
    </div>

    <div class="k-tabs-container">

		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_TAGS_FIELDSET_DETAILS', true)); ?>
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

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
        <div class="k-container">
            <div class="k-container__main">
				<?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
            </div>
            <div class="k-container__sub">
				<?php echo JLayoutHelper::render('joomla.edit.metadata', $this); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>

	</div><!-- .k-tabs-container -->

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>

</form><!-- .k-component -->

<script type="text/javascript">
    Joomla.submitbutton = function(task)
    {
        if (task == 'tag.cancel' || document.formvalidator.isValid(document.id('item-form'))) {
            <?php echo $this->form->getField('description')->save(); ?>
            Joomla.submitform(task, document.getElementById('item-form'));
        }
    }
</script>
