<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_languages
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Add specific helper files for html generation
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
$user		= JFactory::getUser();
$userId		= $user->get('id');
$client		= $this->state->get('filter.client_id', 0) ? JText::_('JADMINISTRATOR') : JText::_('JSITE');
$clientId	= $this->state->get('filter.client_id', 0);
?>

<?php JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'sidebar'); ?>

<!-- Form -->
<form class="k-form-layout -koowa-grid" action="<?php echo JRoute::_('index.php?option=com_languages&view=installed&client='.$clientId); ?>" method="post" id="adminForm" name="adminForm">

    <!-- Table -->
    <div class="k-table-container">
        <div class="k-table">
            <table class="k-js-fixed-table-header k-js-responsive-table">
                <thead>
                <tr>
                    <th>
                        &#160;
                    </th>
                    <th width="25%">
                        <?php echo JText::_('COM_LANGUAGES_HEADING_LANGUAGE'); ?>
                    </th>
                    <th>
                        <?php echo JText::_('COM_LANGUAGES_FIELD_LANG_TAG_LABEL'); ?>
                    </th>
                    <th>
                        <?php echo JText::_('JCLIENT'); ?>
                    </th>
                    <th width="1%">
                        <?php echo JText::_('COM_LANGUAGES_HEADING_DEFAULT'); ?>
                    </th>
                    <th>
                        <?php echo JText::_('JVERSION'); ?>
                    </th>
                    <th>
                        <?php echo JText::_('JDATE'); ?>
                    </th>
                    <th>
                        <?php echo JText::_('JAUTHOR'); ?>
                    </th>
                    <th>
                        <?php echo JText::_('COM_LANGUAGES_HEADING_AUTHOR_EMAIL'); ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->rows as $i => $row) :
                    $canCreate = $user->authorise('core.create',     'com_languages');
                    $canEdit   = $user->authorise('core.edit',       'com_languages');
                    $canChange = $user->authorise('core.edit.state', 'com_languages');
                    ?>
                    <tr>
                        <td width="1%">
                            <?php echo JHtml::_('languages.id', $i, $row->language);?>
                        </td>
                        <td width="25%">
                            <?php echo $this->escape($row->name); ?>
                        </td>
                        <td>
                            <?php echo $this->escape($row->language); ?>
                        </td>
                        <td>
                            <?php echo $client;?>
                        </td>
                        <td class="k-table-data--center">
                            <?php echo JHtml::_('jgrid.isdefault', $row->published, $i, 'installed.', !$row->published && $canChange);?>
                        </td>
                        <td>
                            <?php echo $this->escape($row->version); ?>
                        </td>
                        <td>
                            <?php echo $this->escape($row->creationDate); ?>
                        </td>
                        <td>
                            <?php echo $this->escape($row->author); ?>
                        </td>
                        <td>
                            <?php echo JStringPunycode::emailToUTF8($this->escape($row->authorEmail)); ?>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="boxchecked" value="0" />
            <?php echo JHtml::_('form.token'); ?>
        </div><!-- .k-table -->

        <!-- Pagination -->
        <?php echo JLayoutHelper::render('elysio.pagination', array('view' => $this, 'pages' => $this->pagination->getListFooter())); ?>

    </div><!-- .k-table-container -->

</form><!-- .k-component -->
