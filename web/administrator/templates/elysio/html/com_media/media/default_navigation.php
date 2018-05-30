<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$app   = JFactory::getApplication();
$style = $app->getUserStateFromRequest('media.list.layout', 'layout', 'thumbs', 'word');
?>

<div class="k-optionlist">
    <div class="k-optionlist__content">
        <input type="radio" name="input-option-list" id="thumbs" value="0" <?php echo ($style == "thumbs") ? 'checked' : '';?> />
        <label for="thumbs" onclick="MediaManager.setViewType('thumbs')"><?php echo JText::_('COM_MEDIA_THUMBNAIL_VIEW'); ?></label>
        <input type="radio" name="input-option-list" id="details" value="1" <?php echo ($style == "details") ? 'checked' : '';?> />
        <label for="details" onclick="MediaManager.setViewType('details')"><?php echo JText::_('COM_MEDIA_DETAIL_VIEW'); ?></label>
        <div class="k-optionlist__focus"></div>
    </div>
</div>
