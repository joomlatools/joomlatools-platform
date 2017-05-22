<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_menus
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.framework', true);
?>

<div class="k-form-group">
	<label class="k-button k-button--default" for="showmods">
		<input type="checkbox" id="showmods" />
        <?php echo JText::_('COM_MENUS_ITEM_FIELD_HIDE_UNASSIGNED');?>
	</label>
</div>

<div class="k-table-container">
	<div class="k-table">
		<table>
			<thead>
			<tr>
				<th>
					<?php echo JText::_('COM_MENUS_HEADING_ASSIGN_MODULE');?>
				</th>
				<th>
					<?php echo JText::_('COM_MENUS_HEADING_DISPLAY');?>
				</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($this->modules as $i => &$module) : ?>
				<?php if (is_null($module->menuid)) : ?>
					<?php if (!$module->except || $module->menuid < 0) : ?>
						<tr>
					<?php else : ?>
						<tr>
					<?php endif; ?>
				<?php endif; ?>
				<td>
					<?php $link = 'index.php?option=com_modules&amp;client_id=0&amp;task=module.edit&amp;id=' . $module->id . '&amp;tmpl=component&amp;view=module&amp;layout=modal'; ?>
					<a class="modal" href="<?php echo $link;?>" rel="{handler: 'iframe', size: {x: 900, y: 550}}" title="<?php echo JText::_('COM_MENUS_EDIT_MODULE_SETTINGS');?>">
						<?php echo JText::sprintf('COM_MENUS_MODULE_ACCESS_POSITION', $this->escape($module->title), $this->escape($module->access_title), $this->escape($module->position)); ?></a>
				</td>
				<td>
					<?php if (is_null($module->menuid)) : ?>
						<?php if ($module->except):?>
							<span class="label label-success">
							<?php echo JText::_('JYES'); ?>
						</span>
						<?php else : ?>
							<span class="label label-important">
							<?php echo JText::_('JNO'); ?>
						</span>
						<?php endif;?>
					<?php elseif ($module->menuid > 0) : ?>
						<span class="label label-success">
						<?php echo JText::_('JYES'); ?>
					</span>
					<?php elseif ($module->menuid < 0) : ?>
						<span class="label label-important">
						<?php echo JText::_('JNO'); ?>
					</span>
					<?php else : ?>
						<span class="label label-info">
						<?php echo JText::_('JALL'); ?>
					</span>
					<?php endif; ?>
				</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

	</div>
</div>
