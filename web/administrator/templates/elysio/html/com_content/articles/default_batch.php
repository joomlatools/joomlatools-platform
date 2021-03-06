<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_categories/helpers/html');
JHtml::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_tags/helpers/html');

$published = $this->state->get('filter.published');
?>
<div class="modal hide fade" id="collapseModal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&#215;</button>
		<h3><?php echo JText::_('COM_CONTENT_BATCH_OPTIONS'); ?></h3>
	</div>
	<div class="modal-body modal-batch">
		<p><?php echo JText::_('COM_CONTENT_BATCH_TIP'); ?></p>
        <div class="k-form-group">
            <?php echo JHtml::_('batch.tag'); ?>
        </div>
        <div class="k-form-group">
            <?php echo JHtml::_('batch.language'); ?>
		</div>
        <div class="k-form-group">
            <?php echo JHtml::_('batch.access'); ?>
        </div>
        <?php if ($published >= 0) : ?>
            <div class="k-form-group">
                <?php echo JHtml::_('batch.item', 'com_content'); ?>
            </div>
        <?php endif; ?>
	</div>
	<div class="modal-footer">
		<button class="k-button k-button--default" type="button" onclick="document.id('batch-category-id').value='';document.id('batch-access').value='';document.id('batch-language-id').value='';document.id('batch-tag-id)').value=''" data-dismiss="modal">
			<?php echo JText::_('JCANCEL'); ?>
		</button>
		<button class="k-button k-button--primary" type="submit" onclick="Joomla.submitbutton('article.batch');">
			<?php echo JText::_('JGLOBAL_BATCH_PROCESS'); ?>
		</button>
	</div>
</div>
