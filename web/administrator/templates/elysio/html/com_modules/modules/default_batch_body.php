<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_modules
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$clientId  = $this->state->get('client_id');

// Show only Module Positions of published Templates
$published = 1;
$positions = JHtml::_('modules.positions', $clientId, $published);
$positions['']['items'][] = ModulesHelper::createOption('nochange', JText::_('COM_MODULES_BATCH_POSITION_NOCHANGE'));
$positions['']['items'][] = ModulesHelper::createOption('noposition', JText::_('COM_MODULES_BATCH_POSITION_NOPOSITION'));

// Add custom position to options
$customGroupText = JText::_('COM_MODULES_CUSTOM_POSITION');

// Build field
$attr = array(
	'id'        => 'batch-position-id',
	'list.attr' => 'class="chzn-custom-value input-xlarge" '
		. 'data-custom_group_text="' . $customGroupText . '" '
		. 'data-no_results_text="' . JText::_('COM_MODULES_ADD_CUSTOM_POSITION') . '" '
		. 'data-placeholder="' . JText::_('COM_MODULES_TYPE_OR_SELECT_POSITION') . '" '
);

// Create the copy/move options.
$options = array(
    JHtml::_('select.option', 'c', JText::_('JLIB_HTML_BATCH_COPY')),
    JHtml::_('select.option', 'm', JText::_('JLIB_HTML_BATCH_MOVE'))
);
$attribs = array(
    'class' => 'k-optionlist-trigger'
);
?>

<script>
    kQuery(function($) {
        var input = $('.k-optionlist-trigger input'),
            controls = $('#batch-copy-move .controls')[0];

        // Rename and add markup
        $(controls).removeClass('controls').addClass('k-optionlist__content').append('<div class="k-optionlist__focus"></div>').wrap('<div class="k-optionlist" style="margin-top: 8px;"></div>');

        // Run for each option
        input.each(function() {
            // Variables
            var item = $(this),
                label = item.parent();

            // Move the input outside of the label
            label.before(item);
        });
    });
</script>

<p><?php echo JText::_('COM_MODULES_BATCH_TIP'); ?></p>
<div class="k-form-group">
    <?php echo JHtml::_('batch.language'); ?>
</div>
<div class="k-form-group">
    <?php echo JHtml::_('batch.access'); ?>
</div>
<?php if ($published >= 0) : ?>
    <label id="batch-choose-action-lbl" for="batch-choose-action">
        <?php echo JText::_('COM_MODULES_BATCH_POSITION_LABEL'); ?>
    </label>
    <div id="batch-choose-action" class="k-form-group">
        <?php echo JHtml::_('select.groupedlist', $positions, 'batch[position_id]', $attr) ?>
        <div id="batch-copy-move" class="k-form-group radio">
            <?php echo JHtml::_('select.radiolist', $options, 'batch[move_copy]', $attribs, 'value', 'text', 'm'); ?>
        </div>
    </div>
<?php endif; ?>
