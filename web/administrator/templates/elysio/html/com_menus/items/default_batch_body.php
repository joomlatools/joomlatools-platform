<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_menus
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$options = array(
	JHtml::_('select.option', 'c', JText::_('JLIB_HTML_BATCH_COPY')),
	JHtml::_('select.option', 'm', JText::_('JLIB_HTML_BATCH_MOVE'))
);
$published = $this->state->get('filter.published');
$menuType = JFactory::getApplication()->getUserState('com_menus.items.menutype');
?>
<?php // @TODO: Is this file ven being used?; ?>
<?php if (strlen($menuType) && $menuType != '*') : ?>
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
                <option value=""><?php echo JText::_('JLIB_HTML_BATCH_NO_CATEGORY') ?></option>
                <?php echo JHtml::_('select.options', JHtml::_('menu.menuitems', array('published' => $published, 'checkacl' => (int) $this->state->get('menutypeid')))); ?>
            </select>
		</div>
		<div id="batch-copy-move" class="k-form-group radio">
			<?php echo JText::_('JLIB_HTML_BATCH_MOVE_QUESTION'); ?>
			<?php echo JHtml::_('select.radiolist', $options, 'batch[move_copy]', '', 'value', 'text', 'm'); ?>
		</div>
	<?php endif; ?>
<?php else : ?>
	<p><?php echo JText::_('COM_MENUS_SELECT_MENU_FIRST') ?></p>
<?php endif; ?>
