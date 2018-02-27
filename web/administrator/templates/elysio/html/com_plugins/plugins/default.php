<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_plugins
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

$user      = JFactory::getUser();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$canOrder  = $user->authorise('core.edit.state', 'com_plugins');
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder)
{
    $saveOrderingUrl = 'index.php?option=com_plugins&task=plugins.saveOrderAjax&tmpl=component';
    JHtml::_('sortablelist.sortable', 'pluginList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
?>

<!-- Component -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_plugins&view=plugins'); ?>" method="post" name="adminForm" id="adminForm">

    <!-- Scopebar -->
    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this, 'options' => array('filterButton' => false))); ?>

	<!-- Table -->
	<div class="k-table-container">
		<div class="k-table">
            <table class="k-js-responsive-table" id="pluginList">
				<thead>
					<tr>
                        <th width="1%" class="k-table-data--icon">
                            <?php echo JHtml::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'k-icon-move'); ?>
                        </th>
                        <th width="1%" class="k-table-data--form">
                            <?php echo JHtml::_('grid.checkall'); ?>
                        </th>
                        <th width="1%" class="k-table-data--toggle" data-toggle="true"></th>
                        <th width="1%">
                            <?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'enabled', $listDirn, $listOrder); ?>
                        </th>
                        <th>
                            <?php echo JHtml::_('searchtools.sort', 'COM_PLUGINS_NAME_HEADING', 'name', $listDirn, $listOrder); ?>
                        </th>
                        <th width="11%" data-hide="phone">
                            <?php echo JHtml::_('searchtools.sort', 'COM_PLUGINS_FOLDER_HEADING', 'folder', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'COM_PLUGINS_ELEMENT_HEADING', 'element', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ACCESS', 'access', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'extension_id', $listDirn, $listOrder); ?>
                        </th>
					</tr>
				</thead>
				<tbody>
                <?php foreach ($this->items as $i => $item) :
                    $ordering   = ($listOrder == 'ordering');
                    $canEdit    = $user->authorise('core.edit',       'com_plugins');
                    $canCheckin = $item->checked_out == $user->get('id') || $item->checked_out == 0;
                    $canChange  = $user->authorise('core.edit.state', 'com_plugins') && $canCheckin;
                    ?>
					<tr>
						<td>
							<?php
							$iconClass = '';

							if (!$canChange)
							{
								$iconClass = ' inactive';
							}
							elseif (!$saveOrder)
							{
								$iconClass = ' inactive tip-top hasTooltip" title="' . JHtml::tooltipText('JORDERINGDISABLED');
							}
							?>
							<span class="sortable-handler<?php echo $iconClass ?>">
								<span class="k-positioner k-is-active" data-k-tooltip="{&quot;container&quot;:&quot;.k-ui-container&quot;}" data-original-title="Please order by this column first by clicking the column title"></span>
							</span>
							<?php if ($canChange && $saveOrder) : ?>
								<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering;?>" />
                            <?php endif; ?>
						</td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $item->extension_id); ?>
						</td>
                        <td class="k-table-data--toggle"></td>
						<td>
							<?php echo JHtml::_('jgrid.published', $item->enabled, $i, 'plugins.', $canChange); ?>
						</td>
						<td class="k-table-data--ellipsis">
							<?php if ($item->checked_out) : ?>
								<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'plugins.', $canCheckin); ?>
							<?php endif; ?>
							<?php if ($canEdit) : ?>
								<a href="<?php echo JRoute::_('index.php?option=com_plugins&task=plugin.edit&extension_id='.(int) $item->extension_id); ?>">
									<?php echo $item->name; ?></a>
							<?php else : ?>
									<?php echo $item->name; ?>
							<?php endif; ?>
						</td>
						<td>
							<?php echo $this->escape($item->folder);?>
						</td>
						<td>
							<?php echo $this->escape($item->element);?>
						</td>
						<td>
							<?php echo $this->escape($item->access_level); ?>
						</td>
                        <td>
                            <?php echo (int) $item->extension_id; ?>
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
