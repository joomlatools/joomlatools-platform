<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$user = JFactory::getUser();
?>

<div class="k-gallery__item k-gallery__item--file">
    <div class="k-card">
        <a href="index.php?option=com_media&amp;view=mediaList&amp;tmpl=component&amp;folder=<?php echo $this->_tmp_folder->path_relative; ?>" class="k-card__body">
            <div class="k-ratio-block k-ratio-block--4-to-3">
                <div class="k-ratio-block__body k-flexbox-column">
                    <span class="k-icon-folder-closed k-icon--size-xlarge"></span>
                </div>
            </div>
        </a>
        <div class="k-card__caption">
            <div class="k-flag-object">
                <div class="k-flag-object__aside">
                    <input class="pull-left" type="checkbox" name="rm[]" value="<?php echo $this->_tmp_folder->name; ?>" />
                </div>
                <div class="k-flag-object__body k-overflow-hidden" style="padding-left: 4px;">
                    <div class="k-ellipsis">
                        <div class="k-ellipsis__item">
                            <?php echo JHtml::_('string.truncate', $this->_tmp_folder->name, 20, false); ?>
                        </div>
                    </div>
                </div>
                <?php if ($user->authorise('core.delete', 'com_media')):?>
                    <div class="k-flag-object__aside" style="padding-left: 4px;">
                        <a target="_top" href="index.php?option=com_media&amp;task=folder.delete&amp;tmpl=index&amp;<?php echo JSession::getFormToken(); ?>=1&amp;folder=<?php echo $this->state->folder; ?>&amp;rm[]=<?php echo $this->_tmp_folder->name; ?>" rel="<?php echo $this->_tmp_folder->name; ?> :: <?php echo $this->_tmp_folder->files + $this->_tmp_folder->folders; ?>" title="<?php echo JText::_('JACTION_DELETE');?>">
                            <span class="k-icon-trash"></span>
                        </a>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
