<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_menus
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @deprecated  3.4 Use default_batch_body and default_batch_footer
 */

defined('_JEXEC') or die;

$options = array(
	JHtml::_('select.option', 'c', JText::_('JLIB_HTML_BATCH_COPY')),
	JHtml::_('select.option', 'm', JText::_('JLIB_HTML_BATCH_MOVE'))
);
$published = $this->state->get('filter.published');
?>

<div class="modal hide fade" id="collapseModal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&#215;</button>
		<h3><?php echo JText::_('COM_MENUS_BATCH_OPTIONS'); ?></h3>
	</div>
	<div class="modal-body modal-batch">
		<p><?php echo JText::_('COM_MENUS_BATCH_TIP'); ?></p>
        <div class="k-form-group">
            <?php echo JHtml::_('batch.language'); ?>
        </div>
        <div class="k-form-group">
            <?php echo JHtml::_('batch.access'); ?>
        </div>
        <?php if ($published >= 0) : ?>
            <div id="batch-choose-action" class="k-form-group combo">
                <label id="batch-choose-action-lbl" for="batch-choose-action">
                    <?php echo JText::_('COM_MENUS_BATCH_MENU_LABEL'); ?>
                </label>
                <select name="batch[menu_id]" id="batch-menu-id">
                    <option value=""><?php echo JText::_('JSELECT') ?></option>
                    <?php echo JHtml::_('select.options', JHtml::_('menu.menuitems', array('published' => $published))); ?>
                </select>
            </div>
            <div id="batch-copy-move" class="k-form-group radio">

                <?php // @TODO: Change radiolist below into a list like this; (layouts>joomla.form.field.radio); ?>
                <fieldset class="k-optionlist">
                    <div class="k-optionlist__content">
                        <input type="radio" id="example1" name="example" value="1" checked="checked">
                        <label for="example1">
                            <span>Copy</span>
                        </label>
                        <input type="radio" id="example2" name="example" value="0">
                        <label for="example2">
                            <span>Move</span>
                        </label>
                        <div class="k-optionlist__focus"></div>
                    </div>
                </fieldset>
                <?php echo JHtml::_('select.radiolist', $options, 'batch[move_copy]', '', 'value', 'text', 'm'); ?>
                <?php // @TODO; END ?>

            </div>
        <?php endif; ?>
	</div>
	<div class="modal-footer">
		<button class="k-button k-button--default" type="button" onclick="document.getElementById('batch-menu-id').value='';document.getElementById('batch-access').value='';document.getElementById('batch-language-id').value=''" data-dismiss="modal">
			<?php echo JText::_('JCANCEL'); ?>
		</button>
		<button class="k-button k-button--primary" type="submit" onclick="Joomla.submitbutton('item.batch');">
			<?php echo JText::_('JGLOBAL_BATCH_PROCESS'); ?>
		</button>
	</div>
</div>
