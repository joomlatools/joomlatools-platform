<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_languages
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Add specific helper files for html generation
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');

$user      = JFactory::getUser();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<?php JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'sidebar'); ?>

<!-- Form -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_languages&view=installed&client='.$clientId); ?>" method="post" id="adminForm" name="adminForm">

    <!-- Table -->
    <div class="k-table-container">
        <div class="k-table">
            <table class="k-js-fixed-table-header k-js-responsive-table">
                <thead>
                <tr>
                    <th width="1%" class="k-table-data--form"></th>
                    <th width="1%" class="k-table-data--toggle" data-toggle="true"></th>
                    <th>
                        <?php echo JHtml::_('searchtools.sort', 'COM_LANGUAGES_HEADING_LANGUAGE', 'name', $listDirn, $listOrder); ?>
                    </th>
                    <th data-hide="phone,tablet">
                        <?php echo JHtml::_('searchtools.sort', 'COM_LANGUAGES_HEADING_LANG_TAG', 'language', $listDirn, $listOrder); ?>
                    </th>
                    <th data-hide="phone,tablet">
                        <?php echo JHtml::_('searchtools.sort', 'COM_LANGUAGES_HEADING_DEFAULT', 'published', $listDirn, $listOrder); ?>
                    </th>
                    <th data-hide="phone,tablet">
                        <?php echo JHtml::_('searchtools.sort', 'COM_LANGUAGES_HEADING_VERSION', 'version', $listDirn, $listOrder); ?>
                    </th>
                    <?php if(0): ?>
                    <th data-hide="phone,tablet">
                        <?php echo JHtml::_('searchtools.sort', 'COM_LANGUAGES_HEADING_DATE', 'creationDate', $listDirn, $listOrder); ?>
                    </th>
                    <th data-hide="phone,tablet">
                        <?php echo JHtml::_('searchtools.sort', 'COM_LANGUAGES_HEADING_AUTHOR', 'author', $listDirn, $listOrder); ?>
                    </th>
                    <th data-hide="phone,tablet">
                        <?php echo JHtml::_('searchtools.sort', 'COM_LANGUAGES_HEADING_AUTHOR_EMAIL', 'authorEmail', $listDirn, $listOrder); ?>
                    </th>
                    <?php endif; ?>
                    <th data-hide="phone,tablet">
                        <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'extension_id', $listDirn, $listOrder); ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $version = new JVersion;
                $currentShortVersion = preg_replace('#^([0-9\.]+)(|.*)$#', '$1', $version->getShortVersion());
                foreach ($this->rows as $i => $row) :
                    $canCreate = $user->authorise('core.create',     'com_languages');
                    $canEdit   = $user->authorise('core.edit',       'com_languages');
                    $canChange = $user->authorise('core.edit.state', 'com_languages');
                    ?>
                    <tr>
                        <td class="k-table-data--form">
                            <?php echo JHtml::_('languages.id', $i, $row->language);?>
                        </td>
                        <td class="k-table-data--toggle"></td>
                        <td class="k-table-data--nowrap">
                            <?php echo $this->escape($row->name); ?>
                        </td>
                        <td>
                            <?php echo $this->escape($row->language); ?>
                        </td>
                        <td>
                            <?php echo JHtml::_('jgrid.isdefault', $row->published, $i, 'installed.', !$row->published && $canChange); ?>
                        </td>
                        <td>
                            <?php // Display a Note if language pack version is not equal to Joomla version ?>
                            <?php if (substr($row->version, 0, 3) != $version::RELEASE || substr($row->version, 0, 5) != $currentShortVersion) : ?>
                                <span class="label label-warning hasTooltip" title="<?php echo JText::_('JGLOBAL_LANGUAGE_VERSION_NOT_PLATFORM'); ?>">
                                    <?php echo $row->version; ?>
                                </span>
                            <?php else : ?>
                                <span class="label label-success"><?php echo $row->version; ?></span>
                            <?php endif; ?>
                        </td>
                        <?php if(0): ?>
                        <td>
                            <?php echo $this->escape($row->creationDate); ?>
                        </td>
                        <td>
                            <?php echo $this->escape($row->author); ?>
                        </td>
                        <td>
                            <?php echo JStringPunycode::emailToUTF8($this->escape($row->authorEmail)); ?>
                        </td>
                        <?php endif; ?>
                        <td>
                            <?php echo $this->escape($row->extension_id); ?>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div><!-- .k-table -->

        <!-- Pagination -->
        <?php echo JLayoutHelper::render('elysio.pagination', array('view' => $this, 'pages' => $this->pagination->getListFooter())); ?>

        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <?php echo JHtml::_('form.token'); ?>

    </div><!-- .k-table-container -->

</form><!-- .k-component -->
