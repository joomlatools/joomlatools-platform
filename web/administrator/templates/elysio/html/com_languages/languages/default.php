<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_languages
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.multiselect');
JHtml::_('bootstrap.tooltip');

$user      = JFactory::getUser();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder)
{
    $saveOrderingUrl = 'index.php?option=com_languages&task=languages.saveOrderAjax&tmpl=component';
    JHtml::_('sortablelist.sortable', 'contentList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<?php JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'sidebar'); ?>

<!-- Component -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_languages&view=languages'); ?>" method="post" name="adminForm" id="adminForm">

    <!-- Scopebar -->
    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this), null, array('debug' => false)); ?>

	<!-- Table -->
	<div class="k-table-container">
		<div class="k-table">
            <table class="k-js-responsive-table" id="contentList">
				<thead>
					<tr>
						<th width="1%" class="k-table-data--icon">
                            <?php echo JHtml::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'k-icon-move'); ?>
						</th>
						<th width="1%" class="k-table-data--form">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
                        <th width="1%" class="k-table-data--toggle" data-toggle="true"></th>
                        <th>
                            <?php echo JHtml::_('searchtools.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%">
                            <?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
                        </th>
                        <th data-hide="phone">
                            <?php echo JHtml::_('searchtools.sort', 'COM_LANGUAGES_HEADING_TITLE_NATIVE', 'a.title_native', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'COM_LANGUAGES_HEADING_LANG_TAG', 'a.lang_code', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'COM_LANGUAGES_HEADING_LANG_CODE', 'a.sef', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'COM_LANGUAGES_HEADING_LANG_IMAGE', 'a.image', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ACCESS', 'a.access', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'COM_LANGUAGES_HEADING_HOMEPAGE', 'l.home', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.lang_id', $listDirn, $listOrder); ?>
                        </th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach ($this->items as $i => $item) :
					$ordering  = ($listOrder == 'a.ordering');
					$canCreate = $user->authorise('core.create',     'com_languages');
					$canEdit   = $user->authorise('core.edit',       'com_languages');
					$canChange = $user->authorise('core.edit.state', 'com_languages');
				?>
					<tr>
                        <?php echo JLayoutHelper::render('elysio.ordering', array('canChange' => $canChange, 'saveOrder' => $saveOrder, 'value' => $item->ordering)); ?>
						<td>
							<?php echo JHtml::_('grid.id', $i, $item->lang_id); ?>
						</td>
                        <td class="k-table-data--toggle"></td>
                        <td>
							<span class="editlinktip hasTooltip" title="<?php echo JHtml::tooltipText(JText::_('JGLOBAL_EDIT_ITEM'), $item->title, 0); ?>">
                                <?php if ($canEdit) : ?>
                                    <a href="<?php echo JRoute::_('index.php?option=com_languages&task=language.edit&lang_id=' . (int) $item->lang_id); ?>"><?php echo $this->escape($item->title); ?></a>
                                <?php else : ?>
                                    <?php echo $this->escape($item->title); ?>
                                <?php endif; ?>
							</span>
                        </td>
                        <td>
                            <?php echo JHtml::_('jgrid.published', $item->published, $i, 'languages.', $canChange); ?>
                        </td>
                        <td>
                            <?php echo $this->escape($item->title_native); ?>
                        </td>
                        <td>
                            <?php echo $this->escape($item->lang_code); ?>
                        </td>
                        <td>
                            <?php echo $this->escape($item->sef); ?>
                        </td>
                        <td>
                            <?php echo JHtml::_('image', 'mod_languages/' . $item->image . '.gif', $item->image, array('title' => $item->image), true); ?>&nbsp;<?php echo $this->escape($item->image); ?>
                        </td>
                        <td>
                            <?php echo $this->escape($item->access_level); ?>
                        </td>
                        <td>
                            <?php echo ($item->home == '1') ? JText::_('JYES') : JText::_('JNO'); ?>
                        </td>
                        <td>
                            <?php echo $this->escape($item->lang_id); ?>
                        </td>
					</tr>
					<?php endforeach; ?>
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
