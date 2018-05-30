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

    <div class="k-gallery__item k-gallery__item--file">
        <div class="k-card">
            <a href="<?php echo COM_MEDIA_BASEURL . '/' . $this->_tmp_video->name; ?>" class="k-card__body">
                <div class="k-ratio-block k-ratio-block--4-to-3">
                    <div class="k-ratio-block__body k-flexbox-column">
                        <span class="k-icon-document-video k-icon--size-xlarge"></span><br />
                        <?php echo JHtml::_('string.truncate', $this->_tmp_video->name, 10, false); ?>
                    </div>
                </div>
            </a>
            <?php if ($user->authorise('core.delete', 'com_media')):?>
                <div class="k-card__caption">
                    <input class="pull-left" type="checkbox" name="rm[]" value="<?php echo $this->_tmp_video->name; ?>" />
                    <a class="close delete-item" target="_top" href="index.php?option=com_media&amp;task=file.delete&amp;tmpl=index&amp;<?php echo JSession::getFormToken(); ?>=1&amp;folder=<?php echo $this->state->folder; ?>&amp;rm[]=<?php echo $this->_tmp_video->name; ?>" rel="<?php echo $this->_tmp_video->name; ?>" title="<?php echo JText::_('JACTION_DELETE');?>">&#215;</a>
                </div>
            <?php endif;?>
        </div>
    </div>

<?php
$dispatcher->trigger('onContentAfterDisplay', array('com_media.file', &$this->_tmp_video, &$params));
