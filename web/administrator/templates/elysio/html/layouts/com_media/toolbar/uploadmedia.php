<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$title = JText::_('JTOOLBAR_UPLOAD');
?>
<button data-toggle="collapse" data-target="#collapseUpload" class="k-button k-button--success">
	<span class="k-icon-plus" title="<?php echo $title; ?>"></span> <?php echo $title; ?>
</button>
