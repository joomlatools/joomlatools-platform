<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$input = JFactory::getApplication()->input;
?>

<div class="k-gallery__item k-gallery__item--file">
    <div class="k-card">
        <a href="index.php?option=com_media&amp;view=imagesList&amp;tmpl=component&amp;folder=<?php echo $this->_tmp_folder->path_relative; ?>&amp;asset=<?php echo $input->getCmd('asset');?>&amp;author=<?php echo $input->getCmd('author');?>" class="k-card__body">
            <div class="k-ratio-block k-ratio-block--4-to-3">
                <div class="k-ratio-block__body k-flexbox-column">
                    <span class="k-icon-folder-closed k-icon--size-xlarge"></span>
                </div>
            </div>
        </a>
        <div class="k-card__caption">
            <div class="k-flag-object">
                <div class="k-flag-object__body k-overflow-hidden">
                    <div class="k-ellipsis">
                        <div class="k-ellipsis__item">
                            <?php echo JHtml::_('string.truncate', $this->_tmp_folder->name, 20, false); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

