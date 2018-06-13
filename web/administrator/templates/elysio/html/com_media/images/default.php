<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$user   = JFactory::getUser();
$input  = JFactory::getApplication()->input;
$params = JComponentHelper::getParams('com_media');
$lang   = JFactory::getLanguage();

// Load tooltip instance without HTML support because we have a HTML tag in the tip
JHtml::_('bootstrap.tooltip', '.noHtmlTip', array('html' => false));

// Include jQuery
JHtml::_('jquery.framework');
JHtml::_('script', 'com_media/popup-imagemanager.min.js', false, true, false, false, true);
JHtml::_('stylesheet', 'com_media/popup-imagemanager.css', array(), true);

if ($lang->isRtl())
{
	JHtml::_('stylesheet', 'com_media/popup-imagemanager_rtl.css', array(), true);
}

JFactory::getDocument()->addScriptDeclaration(
	"
		var image_base_path = '" . $params->get('image_path', 'images') . "/';
	"
);
?>

<style type="text/css">
    .k-popup-styling .k-do-flex {
        margin-bottom: 16px;
    }

    .k-popup-styling .k-dont-flex {
        align-self: flex-end;
    }

    @media screen and (min-width: 600px) {
        .k-popup-styling .k-do-flex {
            margin-bottom: 0;
            margin-right: 16px;
        }
    }
</style>

<script>
    function openSidebar() {
        kQuery(function($) {
            // Click the toggle button to display selected image info
            $('.k-off-canvas-toggle--right').trigger('click');
        });
    }

    // Sync select2 with default select
    kQuery(function($) {
        var checkSelect = setInterval(selectCheck, 500);
        var selectEl = $('#folderlist');
        var selectElVal;
        function selectCheck() {
            if ( selectElVal != selectEl.val() ) {
                selectElVal = selectEl.val();
                selectEl.select2('destroy'); // destroying is the only way to synch without triggering iframe reload
                selectEl.select2({ // re-set select2 with new selected option in default select
                    theme: "bootstrap",
                    minimumResultsForSearch: -1
                });
            }
        }
    });
</script>


<!-- Wrapper -->
<div class="k-wrapper k-js-wrapper">

    <!-- Mobile title bar -->
    <div class="k-title-bar k-title-bar--mobile k-js-title-bar">
        <div class="k-title-bar__heading">Insert / Upload file</div>
    </div>

    <!-- Content wrapper -->
    <div class="k-content-wrapper">

        <!-- Content -->
        <div class="k-content k-js-content">

            <!-- Component wrapper -->
            <form class="k-component-wrapper" action="index.php?option=com_media&amp;asset=<?php echo $input->getCmd('asset');?>&amp;author=<?php echo $input->getCmd('author'); ?>" id="imageForm" method="post" enctype="multipart/form-data">

                <!-- Component -->
                <div class="k-component k-js-component">

                    <div class="k-container k-flexbox k-flexbox-column k-do-flex">

                        <div class="k-container__full k-dont-flex messages" style="display: none;">
                            <span id="message"></span><?php echo JHtml::_('image', 'com_media/dots.gif', '...', array('width' => 22, 'height' => 12), true) ?>
                        </div>

                        <div class="k-container__full k-dont-flex">
                            <div class="k-input-group">
                                <label for="folder" class="k-input-group__addon"><?php echo JText::_('COM_MEDIA_DIRECTORY') ?></label>
                                <?php echo $this->folderList; ?>
                                <div class="k-input-group__button">
                                    <button class="k-button k-button--default" type="button" id="upbutton" title="<?php echo JText::_('COM_MEDIA_DIRECTORY_UP') ?>">
                                        <?php echo JText::_('COM_MEDIA_UP') ?>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="k-container__full k-no-padding-top k-no-padding-bottom k-flexbox k-do-flex">
                            <iframe class="k-do-flex k-no-margin" id="imageframe" name="imageframe" src="index.php?option=com_media&amp;view=imagesList&amp;tmpl=component&amp;folder=<?php echo $this->state->folder?>&amp;asset=<?php echo $input->getCmd('asset');?>&amp;author=<?php echo $input->getCmd('author');?>" style="height: auto"></iframe>
                        </div>

                    </div>
                </div><!-- .k-component -->

                <div class="k-sidebar-right k-js-sidebar-right">

                    <div class="k-sidebar-item">
                        <div class="k-sidebar-item__header">
                            Selected file info
                        </div>
                        <div class="k-sidebar-item__content">
                            <div class="k-content-block">
                                <div class="k-form-group">
                                    <label for="f_url"><?php echo JText::_('COM_MEDIA_IMAGE_URL') ?></label>
                                    <input class="k-form-control" type="text" id="f_url" value="" />
                                </div>
                                <div class="k-form-group">
                                    <button class="k-button k-button--success k-button--block button-save-selected" type="button" onclick="<?php if ($this->state->get('field.id')):?>window.parent.jInsertFieldValue(document.getElementById('f_url').value,'<?php echo $this->state->get('field.id');?>');<?php else:?>ImageManager.onok();<?php endif;?>window.parent.jQuery('.modal.in').modal('hide');window.parent.jModalClose();" data-dismiss="modal"><?php echo JText::_('COM_MEDIA_INSERT') ?></button>
                                </div>
                                <?php if (!$this->state->get('field.id')):?>
                                    <div class="k-form-group">
                                        <label title="<?php echo JText::_('COM_MEDIA_ALIGN_DESC'); ?>" class="noHtmlTip" for="f_align"><?php echo JText::_('COM_MEDIA_ALIGN') ?></label>
                                        <select size="1" id="f_align" class="k-form-control">
                                            <option value="" selected="selected"><?php echo JText::_('COM_MEDIA_NOT_SET') ?></option>
                                            <option value="left"><?php echo JText::_('JGLOBAL_LEFT') ?></option>
                                            <option value="center"><?php echo JText::_('JGLOBAL_CENTER') ?></option>
                                            <option value="right"><?php echo JText::_('JGLOBAL_RIGHT') ?></option>
                                        </select>
                                    </div>
                                <?php endif;?>
                                <?php if (!$this->state->get('field.id')):?>
                                    <div class="k-form-group">
                                        <label for="f_alt"><?php echo JText::_('COM_MEDIA_IMAGE_DESCRIPTION') ?></label>
                                        <input class="k-form-control" type="text" id="f_alt" value="" />
                                    </div>
                                    <div class="k-form-group">
                                        <label for="f_title"><?php echo JText::_('COM_MEDIA_TITLE') ?></label>
                                        <input class="k-form-control" type="text" id="f_title" value="" />
                                    </div>
                                    <div class="k-form-group">
                                        <label for="f_caption"><?php echo JText::_('COM_MEDIA_CAPTION') ?></label>
                                        <input class="k-form-control" type="text" id="f_caption" value="" />
                                    </div>
                                    <div class="k-form-group">
                                        <label title="<?php echo JText::_('COM_MEDIA_CAPTION_CLASS_DESC'); ?>" class="noHtmlTip" for="f_caption_class"><?php echo JText::_('COM_MEDIA_CAPTION_CLASS_LABEL') ?></label>
                                        <input class="k-form-control" type="text" list="d_caption_class" id="f_caption_class" value="" />
                                        <datalist id="d_caption_class">
                                            <option value="text-left">
                                            <option value="text-center">
                                            <option value="text-right">
                                        </datalist>
                                    </div>
                                <?php endif;?>
                            </div>
                            <div id="insert-button-container"></div>
                        </div>
                    </div>

                    <input type="hidden" id="dirPath" name="dirPath" />
                    <input type="hidden" id="f_file" name="f_file" />
                    <input type="hidden" id="tmpl" name="component" />

                </div>

            </form><!-- .k-component-wrapper -->

            <?php if ($user->authorise('core.create', 'com_media')) : ?>
                <form class="k-container k-dont-flex" style="border-top: 1px solid #cfcfcf;" action="<?php echo JUri::base(); ?>index.php?option=com_media&amp;task=file.upload&amp;tmpl=component&amp;<?php echo $this->session->getName() . '=' . $this->session->getId(); ?>&amp;<?php echo JSession::getFormToken();?>=1&amp;asset=<?php echo $input->getCmd('asset'); ?>&amp;author=<?php echo $input->getCmd('author'); ?>&amp;view=images" id="uploadForm" name="uploadForm" method="post" enctype="multipart/form-data">
                    <div class="k-container__full" id="uploadform">
                        <div class="k-flexbox-from-beta k-popup-styling">
                            <div class="k-do-flex">
                                <fieldset id="upload-noflash" class="k-file-input-container">
                                    <div class="k-file-input">
                                        <input required class="k-js-file-input" type="file" id="upload-file" name="Filedata[]" data-multiple-caption="{count} files selected" multiple />
                                        <label for="upload-file">
                                            <span class="k-file-input__button">
                                                <span class="k-icon-data-transfer-upload" aria-hidden="true"></span>
                                                Choose file(s) <?php echo $this->config->get('upload_maxsize') == '0' ? '' : '<small>(' . $this->config->get('upload_maxsize') . 'MB)</small>'; ?>
                                            </span>
                                            <span class="k-file-input__files"></span>
                                        </label>
                                    </div>
                                    <?php JFactory::getSession()->set('com_media.return_url', 'index.php?option=com_media&view=images&tmpl=component&fieldid=' . $input->getCmd('fieldid', '') . '&e_name=' . $input->getCmd('e_name') . '&asset=' . $input->getCmd('asset') . '&author=' . $input->getCmd('author')); ?>
                                </fieldset>
                            </div>
                            <div class="k-dont-flex">
                                <button class="k-button k-button--primary" id="upload-submit">
                                    <?php echo JText::_('COM_MEDIA_START_UPLOAD'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endif; ?>

        </div><!-- .k-content -->

    </div><!-- .k-content-wrapper -->

</div><!-- .k-wrapper -->