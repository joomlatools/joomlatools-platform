<?php
defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

$app		= JFactory::getApplication();
$user		= JFactory::getUser();
$userId		= $user->get('id');
$extension	= $this->escape($this->state->get('filter.extension'));
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$ordering 	= ($listOrder == 'a.lft');
$saveOrder 	= ($listOrder == 'a.lft' && strtolower($listDirn) == 'asc');

if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_categories&task=categories.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'categoryList', 'adminForm', strtolower($listDirn), $saveOrderingUrl, false, true);
}

$sortFields = $this->getSortFields();
?>

<?php JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'submenu'); ?>

<!-- Form -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_categories&view=categories'); ?>" method="post" name="adminForm" id="adminForm">

    <!-- Scopebar -->
    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this), null, array('debug' => false)); ?>

    <!-- Onboarding -->
    <?php echo JLayoutHelper::render('elysio.onboarding', array('items' => $this->items, 'type' => 'article')); ?>

    <!-- Table -->
    <div class="k-table-container<?php echo (!$this->items) ? ' k-hidden' : '' ?>">
        <div class="k-table">
            <table class="k-js-responsive-table" id="categoryList">
				<thead>
					<tr>
						<th width="1%" class="k-table-data--icon">
							<?php echo JHtml::_('searchtools.sort', '', 'a.lft', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
						</th>
                        <th width="1%" class="k-table-data--form">
                            <?php echo JHtml::_('grid.checkall'); ?>
                        </th>
                        <th width="1%" class="k-table-data--toggle" data-toggle="true"></th>
						<th>
							<?php echo JHtml::_('searchtools.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
						</th>
						<th width="1%" data-hide="phone">
							<?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
						</th>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ACCESS', 'a.access', $listDirn, $listOrder); ?>
						</th>
						<?php if ($this->assoc) : ?>
							<th width="1%" data-hide="phone,tablet">
								<?php echo JHtml::_('searchtools.sort', 'COM_CATEGORY_HEADING_ASSOCIATION', 'association', $listDirn, $listOrder); ?>
							</th>
						<?php endif; ?>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_LANGUAGE', 'language', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?>
						</th>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->items as $i => $item) : ?>
						<?php
						$orderkey   = array_search($item->id, $this->ordering[$item->parent_id]);
						$canEdit    = $user->authorise('core.edit',       $extension . '.category.' . $item->id);
						$canCheckin = $item->checked_out == $userId || $item->checked_out == 0;
						$canEditOwn = $user->authorise('core.edit.own',   $extension . '.category.' . $item->id) && $item->created_user_id == $userId;
						$canChange  = $user->authorise('core.edit.state', $extension . '.category.' . $item->id) && $canCheckin;

						// Get the parents of item for sorting
						if ($item->level > 1)
						{
							$parentsStr = "";
							$_currentParentId = $item->parent_id;
							$parentsStr = " " . $_currentParentId;
							for ($i2 = 0; $i2 < $item->level; $i2++)
							{
								foreach ($this->ordering as $k => $v)
								{
									$v = implode("-", $v);
									$v = "-" . $v . "-";
									if (strpos($v, "-" . $_currentParentId . "-") !== false)
									{
										$parentsStr .= " " . $k;
										$_currentParentId = $k;
										break;
									}
								}
							}
						}
						else
						{
							$parentsStr = "";
						}
						?>
						<tr sortable-group-id="<?php echo $item->parent_id; ?>" item-id="<?php echo $item->id ?>" parents="<?php echo $parentsStr ?>" level="<?php echo $item->level ?>">
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
									<i class="icon-menu"></i>
								</span>
								<?php if ($canChange && $saveOrder) : ?>
									<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $orderkey + 1; ?>" />
								<?php endif; ?>
							</td>
							<td>
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							</td>
                            <td class="k-table-data--toggle"></td>
							<td>
								<?php echo str_repeat('<span class="gi">&mdash;</span>', $item->level - 1) ?>
								<?php if ($item->checked_out) : ?>
									<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'categories.', $canCheckin); ?>
								<?php endif; ?>
								<?php if ($canEdit || $canEditOwn) : ?>
									<a href="<?php echo JRoute::_('index.php?option=com_categories&task=category.edit&id=' . $item->id . '&extension=' . $extension); ?>">
										<?php echo $this->escape($item->title); ?></a>
								<?php else : ?>
									<?php echo $this->escape($item->title); ?>
								<?php endif; ?>
								<span class="small" title="<?php echo $this->escape($item->path); ?>">
									<?php if (empty($item->note)) : ?>
										<?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($item->alias)); ?>
									<?php else : ?>
										<?php echo JText::sprintf('JGLOBAL_LIST_ALIAS_NOTE', $this->escape($item->alias), $this->escape($item->note)); ?>
									<?php endif; ?>
								</span>
							</td>
                            <td>
                                <?php echo JHtml::_('jgrid.published', $item->published, $i, 'categories.', $canChange); ?>
                            </td>
							<td>
								<?php echo $this->escape($item->access_level); ?>
							</td>
							<?php if ($this->assoc) : ?>
								<td>
									<?php if ($item->association): ?>
										<?php echo JHtml::_('CategoriesAdministrator.association', $item->id, $extension); ?>
									<?php endif; ?>
								</td>
							<?php endif; ?>
							<td>
								<?php if ($item->language == '*') : ?>
									<?php echo JText::alt('JALL', 'language'); ?>
								<?php else: ?>
									<?php echo $item->language_title ? $this->escape($item->language_title) : JText::_('JUNDEFINED'); ?>
								<?php endif; ?>
							</td>
							<td>
								<span title="<?php echo sprintf('%d-%d', $item->lft, $item->rgt); ?>">
									<?php echo (int) $item->id; ?></span>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
        </div><!-- .k-table -->

        <!-- Pagination -->
        <?php echo JLayoutHelper::render('elysio.pagination', array('view' => $this, 'pages' => $this->pagination->getListFooter())); ?>

		<input type="hidden" name="extension" value="<?php echo $extension; ?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>

	</div><!-- .k-table-container -->

</form><!-- .k-component -->

<div class="k-dynamic-content-holder">
    <?php //Load the batch processing form. ?>
    <?php echo $this->loadTemplate('batch'); ?>

    <script type="text/javascript">
        Joomla.orderTable = function()
        {
            table = document.getElementById("sortTable");
            direction = document.getElementById("directionTable");
            order = table.options[table.selectedIndex].value;
            if (order != '<?php echo $listOrder; ?>')
            {
                dirn = 'asc';
            }
            else
            {
                dirn = direction.options[direction.selectedIndex].value;
            }
            Joomla.tableOrdering(order, dirn, '');
        }
    </script>
</div>
