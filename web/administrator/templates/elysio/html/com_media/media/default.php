<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$user  = JFactory::getUser();
$input = JFactory::getApplication()->input;
$lang  = JFactory::getLanguage();
$style = JFactory::getApplication()->getUserStateFromRequest('media.list.layout', 'layout', 'thumbs', 'word');

if (DIRECTORY_SEPARATOR == '\\')
{
	$base = str_replace(DIRECTORY_SEPARATOR, "\\\\", COM_MEDIA_BASE);
}
else
{
	$base = COM_MEDIA_BASE;
}

JFactory::getDocument()->addScriptDeclaration(
	"
		var basepath = '" . $base . "';
		var viewstyle = '" . $style . "';
	"
);

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.framework');
JHtml::_('script', 'com_media/mediamanager.min.js', false, true);
JHtml::_('script', 'com_media/mediaelement-and-player.js', false, true);
JHtml::_('stylesheet', 'com_media/mediaelementplayer.css', array(), true);
JHtml::_('stylesheet', 'system/mootree.css', array(), true);

if ($lang->isRtl())
{
	JHtml::_('stylesheet', 'com_media/mootree_rtl.css', array(), true);
}
?>


<!-- Sidebar -->
<div class="k-sidebar-left k-js-sidebar-left k-hidden" id="k-js-move-sidebar">
    <div class="k-sidebar-item">
        <div class="k-sidebar-item__header">
            <?php echo JText::_('COM_MEDIA_FOLDERS');?>
        </div>

        <?php $GLOBALS['mediaTreeId'] = 0; ?>
        <?php $GLOBALS['mediaTreeParentID'] = false; ?>

        <div class="k-tree" id="k-jqtree"></div>
        <script type="text/javascript" defer>
            kQuery(function($) {
                $(document).ready(function () {
                    new Koowa.Tree('#k-jqtree', {
                        "data": [<?php echo preg_replace('/\s+/', '', $this->loadTemplate('folders')); ?>],
                        "autoOpen": true
                    });
                });
                $('#k-jqtree').on(
                    'tree.click',
                    function(event) {
                        var node = event.node;
                        $('#folderframe').attr('src', node.url);
                    }
                );
            });
            // might be usable for changing the tree selected item on iframe change
            var iframeChangeScript = function(location) {
                console.log(location.href.substr(location.href.lastIndexOf('=') + 1));
                // kQuery('#k-jqtree').tree('selectNode', 2);
            }
        </script>

    </div>
</div>
<script>
    kQuery(function($) {
        $('#k-js-move-sidebar').detach().prependTo('.k-content-wrapper').removeClass('k-hidden');
    });
</script>

















<div class="k-component k-js-component">

	<div class="k-container">
        <div class="k-container__full">
            <?php echo $this->loadTemplate('navigation'); ?>
        </div>
    </div>
	<div class="k-container k-flexbox-from-charlie k-do-flex k-flexbox-column">

        <?php if (($user->authorise('core.create', 'com_media')) and $this->require_ftp) : ?>
            <form action="index.php?option=com_media&amp;task=ftpValidate" name="ftpForm" id="ftpForm" method="post">
                <fieldset title="<?php echo JText::_('COM_MEDIA_DESCFTPTITLE'); ?>">
                    <legend><?php echo JText::_('COM_MEDIA_DESCFTPTITLE'); ?></legend>
                    <?php echo JText::_('COM_MEDIA_DESCFTP'); ?>
                    <label for="username"><?php echo JText::_('JGLOBAL_USERNAME'); ?></label>
                    <input type="text" id="username" name="username" size="70" value="" />

                    <label for="password"><?php echo JText::_('JGLOBAL_PASSWORD'); ?></label>
                    <input type="password" id="password" name="password" size="70" value="" />
                </fieldset>
            </form>
        <?php endif; ?>

        <form class="k-js-grid-controller k-js-grid" action="index.php?option=com_media" name="adminForm" id="mediamanager-form" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="cb1" id="cb1" value="0" />
            <input class="update-folder" type="hidden" name="folder" id="folder" value="<?php echo $this->state->folder; ?>" />
        </form>

        <?php if ($user->authorise('core.create', 'com_media')):?>
            <!-- File Upload Form -->
            <div id="collapseUpload" class="collapse">
                <form action="<?php echo JUri::base(); ?>index.php?option=com_media&amp;task=file.upload&amp;tmpl=component&amp;<?php echo $this->session->getName() . '=' . $this->session->getId(); ?>&amp;<?php echo JSession::getFormToken();?>=1&amp;format=html" id="uploadForm" class="k-container__full" name="uploadForm" method="post" enctype="multipart/form-data">
                    <div id="uploadform">
                        <fieldset id="upload-noflash" class="k-file-input-container">
                            <div class="k-file-input">
                                <input required class="k-js-file-input" type="file" id="upload-file" name="Filedata[]" data-multiple-caption="{count} files selected" multiple />
                                <label for="upload-file">
                                    <span class="k-file-input__button">
                                        <span class="k-icon-data-transfer-upload" aria-hidden="true"></span>
                                        Choose a file&hellip;
                                    </span>
                                    <span class="k-file-input__files"></span>
                                </label>
                            </div>
                            <input class="update-folder" type="hidden" name="folder" id="folder" value="<?php echo $this->state->folder; ?>" />
                            <?php JFactory::getSession()->set('com_media.return_url', 'index.php?option=com_media'); ?>
                        </fieldset>
                        <p class="help-block">
                            <?php echo $this->config->get('upload_maxsize') == '0' ? JText::_('COM_MEDIA_UPLOAD_FILES_NOLIMIT') : JText::sprintf('COM_MEDIA_UPLOAD_FILES', $this->config->get('upload_maxsize')); ?>
                        </p>
                        <p>
                            <button class="btn btn-primary" id="upload-submit"><span class="icon-upload icon-white"></span> <?php echo JText::_('COM_MEDIA_START_UPLOAD'); ?></button>
                        </p>
                    </div>
                </form>
            </div>
            <div id="collapseFolder" class="collapse">
                <form action="index.php?option=com_media&amp;task=folder.create&amp;tmpl=<?php echo $input->getCmd('tmpl', 'index');?>" name="folderForm" id="folderForm" class="k-container__full" method="post">
                    <div class="k-input-group">
                        <input class="k-form-control" type="text" id="folderpath" readonly="readonly" />
                        <input class="update-folder" type="hidden" name="folderbase" id="folderbase" value="<?php echo $this->state->folder; ?>" />
                        <input class="k-form-control" type="text" id="foldername" name="foldername" required />
                        <div class="k-input-group__button">
                            <button type="submit" class="k-button k-button--default">
                                <span class="k-icon-data-transfer-upload"></span>
                                <?php echo JText::_('COM_MEDIA_CREATE_FOLDER'); ?>
                            </button>
                        </div>
                    </div>
                    <?php echo JHtml::_('form.token'); ?>
                </form>
            </div>
        <?php endif;?>

        <form class="k-flexbox-from-charlie k-do-flex" action="index.php?option=com_media&amp;task=folder.create&amp;tmpl=<?php echo $input->getCmd('tmpl', 'index');?>" name="folderForm" id="folderForm" method="post">
            <iframe class="k-do-flex" src="index.php?option=com_media&amp;view=mediaList&amp;tmpl=component&amp;folder=<?php echo $this->state->folder;?>" id="folderframe" name="folderframe" width="100%" marginwidth="0" marginheight="0" scrolling="auto" onLoad="iframeChangeScript(this.contentWindow.location);" style="border:none;"></iframe>
            <?php echo JHtml::_('form.token'); ?>
        </form>

    </div>

    <?php // Pre render all the bootstrap modals on the parent window

    echo JHtml::_(
        'bootstrap.renderModal',
        'imagePreview',
        array(
            'title' => JText::_('COM_MEDIA_PREVIEW'),
            'footer' => '<a type="button" class="btn" data-dismiss="modal" aria-hidden="true">'
                . JText::_("JLIB_HTML_BEHAVIOR_CLOSE") . '</a>'
        ),
        '<div id="image" style="text-align:center;"><img id="imagePreviewSrc" src="../media/jui/img/alpha.png" alt="preview" style="max-width:100%; max-height:300px;"/></div>'
    );

    echo JHtml::_(
        'bootstrap.renderModal',
        'videoPreview',
        array(
            'title' => JText::_('COM_MEDIA_PREVIEW'),
            'footer' => '<a type="button" class="btn" data-dismiss="modal" aria-hidden="true">'
                . JText::_("JLIB_HTML_BEHAVIOR_CLOSE") . '</a>'
        ),
        '<div id="videoPlayer" style="z-index: -100;"><video id="mejsPlayer" style="height: 250px;"/></div>'
    );
    ?>

</div>
