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
$dispatcher->trigger('onContentBeforeDisplay', array('com_media.file', &$this->_tmp_doc, &$params));
?>

    <div class="k-gallery__item k-gallery__item--file">
        <div class="k-card">
            <div class="k-card__body">
                <div class="k-ratio-block k-ratio-block--4-to-3">
                    <div class="k-ratio-block__body k-flexbox-column">
                        <span class="k-icon-document-document k-icon--size-xlarge"></span><br />
                        <?php echo JHtml::_('string.truncate', $this->_tmp_doc->name, 10, false); ?>
                    </div>
                </div>
            </div>
            <?php if ($user->authorise('core.delete', 'com_media')):?>
                <div class="k-card__caption">
                    <a class="close delete-item" target="_top" href="index.php?option=com_media&amp;task=file.delete&amp;tmpl=index&amp;<?php echo JSession::getFormToken(); ?>=1&amp;folder=<?php echo $this->state->folder; ?>&amp;rm[]=<?php echo $this->_tmp_doc->name; ?>" rel="<?php echo $this->_tmp_doc->name; ?>" title="<?php echo JText::_('JACTION_DELETE');?>">&#215;</a>
                    <input class="pull-left" type="checkbox" name="rm[]" value="<?php echo $this->_tmp_doc->name; ?>" />
                </div>
            <?php endif;?>
        </div>
    </div>

<?php if(1==2): ?>
<li class="imgOutline thumbnail height-80 width-80 center">



    <div class="height-50">
		<a style="display: block; width: 100%; height: 100%" title="<?php echo $this->_tmp_doc->name; ?>" >
			<?php echo JHtml::_('image', $this->_tmp_doc->icon_32, $this->_tmp_doc->name, null, true, true) ? JHtml::_('image', $this->_tmp_doc->icon_32, $this->_tmp_doc->title, null, true) : JHtml::_('image', 'com_media/con_info.png', $this->_tmp_doc->name, null, true); ?></a>
	</div>
	<div class="small" title="<?php echo $this->_tmp_doc->name; ?>" >

	</div>
</li>
<?php endif; ?>

<?php $dispatcher->trigger('onContentAfterDisplay', array('com_media.file', &$this->_tmp_doc, &$params));
