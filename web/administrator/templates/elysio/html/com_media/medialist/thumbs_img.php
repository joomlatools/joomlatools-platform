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
$dispatcher->trigger('onContentBeforeDisplay', array('com_media.file', &$this->_tmp_img, &$params));
?>

    <div class="k-gallery__item k-gallery__item--file">
        <div class="k-card">
            <a href="<?php echo COM_MEDIA_BASEURL . '/' . $this->_tmp_img->path_relative; ?>" class="k-card__body">
                <div class="k-ratio-block k-ratio-block--4-to-3">
                    <div class="k-ratio-block__body">
                        <?php echo JHtml::_('image', COM_MEDIA_BASEURL . '/' . $this->_tmp_img->path_relative, JText::sprintf('COM_MEDIA_IMAGE_TITLE', $this->_tmp_img->title, JHtml::_('number.bytes', $this->_tmp_img->size))); ?>
                    </div>
                </div>
            </a>
            <div class="k-card__caption">
                <?php if ($user->authorise('core.delete', 'com_media')):?>
                <input class="pull-left" type="checkbox" name="rm[]" value="<?php echo $this->_tmp_img->name; ?>" />
                <?php endif;?>
                <?php echo JHtml::_('string.truncate', $this->_tmp_img->name, 10, false); ?>
                <?php if ($user->authorise('core.delete', 'com_media')):?>
                <a class="close delete-item" target="_top"
                   href="index.php?option=com_media&amp;task=file.delete&amp;tmpl=index&amp;<?php echo JSession::getFormToken(); ?>=1&amp;folder=<?php echo $this->state->folder; ?>&amp;rm[]=<?php echo $this->_tmp_img->name; ?>"
                   rel="<?php echo $this->_tmp_img->name; ?>" title="<?php echo JText::_('JACTION_DELETE'); ?>">&#215;</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php $dispatcher->trigger('onContentAfterDisplay', array('com_media.file', &$this->_tmp_img, &$params));
