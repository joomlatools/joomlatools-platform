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

$params     = new Registry;
$dispatcher = JEventDispatcher::getInstance();
$dispatcher->trigger('onContentBeforeDisplay', array('com_media.file', &$this->_tmp_img, &$params));
?>

<script>
    kQuery(function($) {
        $('.k-card').on('click', function() {
            $('.k-card').removeClass('k-is-selected');
            $(this).addClass('k-is-selected');
        })
    });
</script>

<div class="k-gallery__item k-gallery__item--file">
    <div class="k-card">
        <a href="javascript:ImageManager.populateFields('<?php echo $this->_tmp_img->path_relative; ?>')" class="k-card__body img-preview" onclick="parent.openSidebar()">
            <div class="k-ratio-block k-ratio-block--4-to-3">
                <div class="k-ratio-block__body">
                    <?php echo JHtml::_('image', $this->baseURL . '/' . $this->_tmp_img->path_relative, JText::sprintf('COM_MEDIA_IMAGE_TITLE', $this->_tmp_img->title, JHtml::_('number.bytes', $this->_tmp_img->size))); ?>
                </div>
            </div>
        </a>
        <div class="k-card__caption">
            <div class="k-flag-object">
                <div class="k-flag-object__body k-overflow-hidden">
                    <div class="k-ellipsis">
                        <div class="k-ellipsis__item">
                            <?php echo JHtml::_('string.truncate', $this->_tmp_img->name, 20, false); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$dispatcher->trigger('onContentAfterDisplay', array('com_media.file', &$this->_tmp_img, &$params));
