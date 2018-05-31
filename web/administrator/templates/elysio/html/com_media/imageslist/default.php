<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$lang = JFactory::getLanguage();

JHtml::_('stylesheet', 'com_media/popup-imagelist.css', array(), true);

if ($lang->isRtl())
{
	JHtml::_('stylesheet', 'com_media/popup-imagelist_rtl.css', array(), true);
}

JFactory::getDocument()->addScriptDeclaration("var ImageManager = window.parent.ImageManager;");
JFactory::getDocument()->addStyleDeclaration(
	"
		@media (max-width: 767px) {
			li.imgOutline.thumbnail.height-80.width-80.center {
				float: left;
				margin-left: 15px;
			}
		}
	"
);
?>

<!-- Wrapper -->
<div class="k-wrapper k-js-wrapper">

    <!-- Content wrapper -->
    <div class="k-content-wrapper">

        <!-- Content -->
        <div class="k-content k-js-content">

            <!-- Component wrapper -->
            <div class="k-component-wrapper">

                <!-- Component -->
                <div class="k-component">

                    <?php if (count($this->images) > 0 || count($this->folders) > 0) : ?>
                        <!-- Gallery -->
                        <div class="k-overflow">
                            <div class="k-gallery k-js-gallery k-gallery--xs">
                                <div class="k-gallery__items manager thumbnails">
                                    <?php for ($i = 0, $n = count($this->folders); $i < $n; $i++) :
                                        $this->setFolder($i);
                                        echo $this->loadTemplate('folder');
                                    endfor; ?>

                                    <?php for ($i = 0, $n = count($this->images); $i < $n; $i++) :
                                        $this->setImage($i);
                                        echo $this->loadTemplate('image');
                                    endfor; ?>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="k-empty-state" style="background: transparent;">
                            <p><?php echo JText::_('COM_MEDIA_NO_IMAGES_FOUND'); ?></p>
                        </div>
                    <?php endif; ?>

                </div><!-- .k-component -->

            </div><!-- .k-component-wrapper -->

        </div><!-- .k-content -->

    </div><!-- .k-content-wrapper -->

</div><!-- .k-wrapper -->

