<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

JHtml::_('bootstrap.tooltip');

$user       = JFactory::getUser();
$params     = new Registry;
$dispatcher = JEventDispatcher::getInstance();
$dispatcher->trigger('onContentBeforeDisplay', array('com_media.file', &$this->_tmp_video, &$params));

JFactory::getDocument()->addScriptDeclaration("
jQuery(document).ready(function($){
	window.parent.jQuery('#videoPreview').on('hidden', function () {
		window.parent.jQuery('#mejsPlayer')[0].player.pause();
	});
});
");
?>

<tr>
    <td class="k-table-data--toggle"></td>
    <td>
        <input type="checkbox" name="rm[]" value="<?php echo $this->_tmp_video->name; ?>" />
    </td>
	<td>
		<a class="video-preview" href="<?php echo COM_MEDIA_BASEURL . '/' . $this->_tmp_video->name; ?>" title="<?php echo $this->_tmp_video->title; ?>">
            <span class="k-icon-document-video"></span>
        </a>
	</td>
	<td class="description">
		<a class="video-preview" href="<?php echo COM_MEDIA_BASEURL . '/' . $this->_tmp_video->name; ?>" title="<?php echo $this->_tmp_video->name; ?>">
            <?php echo $this->escape($this->_tmp_video->title); ?>
		</a>
	</td>
	<td class="dimensions">
		<?php // Can we figure out the dimensions of the video? ?>
	</td>
	<td class="filesize">
		<?php echo JHtml::_('number.bytes', $this->_tmp_video->size); ?>
	</td>
	<?php if ($user->authorise('core.delete', 'com_media')):?>
    <td class="k-table-data--center">
        <a class="delete-item" target="_top" href="index.php?option=com_media&amp;task=file.delete&amp;tmpl=index&amp;<?php echo JSession::getFormToken(); ?>=1&amp;folder=<?php echo $this->state->folder; ?>&amp;rm[]=<?php echo $this->_tmp_video->name; ?>" rel="<?php echo $this->_tmp_video->name; ?>">
            <span class="k-icon-trash hasTooltip" title="<?php echo JHtml::tooltipText('JACTION_DELETE');?>"></span>
        </a>
    </td>
	<?php endif;?>
</tr>

<?php
$dispatcher->trigger('onContentAfterDisplay', array('com_media.file', &$this->_tmp_video, &$params));
