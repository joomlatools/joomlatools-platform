<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

$user		= JFactory::getUser();
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$sortFields = $this->getSortFields();

JText::script('COM_USERS_GROUPS_CONFIRM_DELETE');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'groups.delete')
		{
			var f = document.adminForm;
			var cb='';
<?php foreach ($this->items as $i => $item):?>
<?php if ($item->user_count > 0):?>
			cb = f['cb'+<?php echo $i;?>];
			if (cb && cb.checked)
			{
				if (confirm(Joomla.JText._('COM_USERS_GROUPS_CONFIRM_DELETE')))
				{
					Joomla.submitform(task);
				}
				return;
			}
<?php endif;?>
<?php endforeach;?>
		}
		Joomla.submitform(task);
	}
</script>
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

<?php JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'sidebar'); ?>

<form class="k-list-layout -koowa-grid" action="<?php echo JRoute::_('index.php?option=com_users&view=groups');?>" method="post" name="adminForm" id="adminForm">

	<!-- Scopebar -->
	<div class="k-scopebar" id="filter-bar">

		<!-- Filters -->
		<div class="k-scopebar__item k-scopebar__item--fluid">

			<!-- Search toggle button -->
			<button type="button" class="k-toggle-search"><span class="k-icon-magnifying-glass"></span><span class="visually-hidden">Search</span></button>

		</div><!-- .k-scopebar__item--fluid -->

		<!-- Search -->
		<div class="k-scopebar__item k-scopebar__search">
			<div class="k-search__container k-search__container--has-both-buttons">
				<input class="k-search__field" type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" />
				<button type="submit" class="k-search__button-search" title="Search">
					<span class="k-icon-magnifying-glass"></span>
				</button>
				<button type="button" class="k-search__button-empty" title="Clear" onclick="document.id('filter_search').value='';this.form.submit();">
					<span>X</span>
				</button>
			</div>
		</div><!-- .k-scopebar__search -->

	</div><!-- .k-scopebar -->

	<!-- Table -->
	<div class="k-table-container">
		<div class="k-table">
			<table class="table--fixed footable select-rows">
				<thead>
					<tr>
						<th width="1%">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
						<th>
							<?php echo JHtml::_('grid.sort', 'COM_USERS_HEADING_GROUP_TITLE', 'a.title', $listDirn, $listOrder); ?>
						</th>
						<th width="1%" class="k-table-data--center">
							<?php echo JText::_('COM_USERS_HEADING_USERS_IN_GROUP'); ?>
						</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($this->items as $i => $item) :
					$canCreate = $user->authorise('core.create', 'com_users');
					$canEdit   = $user->authorise('core.edit',    'com_users');

					// If this group is super admin and this user is not super admin, $canEdit is false
					if (!$user->authorise('core.admin') && (JAccess::checkGroup($item->id, 'core.admin')))
					{
						$canEdit = false;
					}
					$canChange	= $user->authorise('core.edit.state',	'com_users');
				?>
					<tr>
						<td>
							<?php if ($canEdit) : ?>
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							<?php endif; ?>
						</td>
						<td>
							<?php echo str_repeat('<span class="gi">|&mdash;</span>', $item->level) ?>
							<?php if ($canEdit) : ?>
							<a href="<?php echo JRoute::_('index.php?option=com_users&task=group.edit&id='.$item->id);?>">
								<?php echo $this->escape($item->title); ?></a>
							<?php else : ?>
								<?php echo $this->escape($item->title); ?>
							<?php endif; ?>
							<?php if (JDEBUG) : ?>
								<div class="small"><a href="<?php echo JRoute::_('index.php?option=com_users&view=debuggroup&group_id='.(int) $item->id);?>">
								<?php echo JText::_('COM_USERS_DEBUG_GROUP');?></a></div>
							<?php endif; ?>
						</td>
						<td class="k-table-data--center">
							<?php echo $item->user_count ? $item->user_count : ''; ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
			<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div><!-- .k-table -->

		<!-- Pagination -->
		<div class="k-table-pagination">
			<?php echo $this->pagination->getListFooter(); ?>
		</div><!-- .k-table-pagination -->

	</div><!-- .k-table-container -->

</form><!-- .k-list-layout -->
