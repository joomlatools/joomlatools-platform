<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

?>
<a class="k-button k-button--default" type="button" onclick="document.getElementById('batch-group-id').value=''" data-dismiss="modal">
	<?php echo JText::_('JCANCEL'); ?>
</a>
<button class="k-button k-button--success" type="submit" onclick="Joomla.submitbutton('user.batch');">
	<?php echo JText::_('JGLOBAL_BATCH_PROCESS'); ?>
</button>