<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<div class="k-form-group">
	<?php echo $this->form->getLabel('metadesc'); ?>
    <?php echo $this->form->getInput('metadesc'); ?>
</div>
<div class="k-form-group">
	<?php echo $this->form->getLabel('metakey'); ?>
    <?php echo $this->form->getInput('metakey'); ?>
</div>
<?php foreach($this->form->getGroup('metadata') as $field): ?>
    <div class="k-form-group">
	<?php if (!$field->hidden): ?>
		<?php echo $field->label; ?>
	<?php endif; ?>
    <?php echo $field->input; ?>
</div>
<?php endforeach; ?>
