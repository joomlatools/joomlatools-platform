<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_modules
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$text = JText::_('JTOOLBAR_CANCEL');
?>
<button onclick="location.href='index.php?option=com_modules'" class="k-button k-button--default" title="<?php echo $text; ?>">
	<span class="k-icon-x"></span> <?php echo $text; ?>
</button>