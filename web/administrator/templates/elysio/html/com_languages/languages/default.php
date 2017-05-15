<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_languages
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('bootstrap.tooltip');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$n			= count($this->items);
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_languages');
$saveOrder	= $listOrder == 'a.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_languages&task=languages.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'contentList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}

$sortFields = $this->getSortFields();
?>
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

<!-- Form -->
<form class="k-form-layout -koowa-grid" action="<?php echo JRoute::_('index.php?option=com_languages&view=languages'); ?>" method="post" name="adminForm" id="adminForm">

	<!-- Scopebar -->
	<div class="k-scopebar" id="filter-bar">

		<!-- Filters -->
		<div class="k-scopebar__item k-scopebar__item--fluid">

			<!-- Search button -->
			<button type="button" class="k-toggle-search"><span class="k-icon-magnifying-glass"></span><span class="visually-hidden">Search</span></button>

		</div><!-- .k-scopebar__item--fluid -->

		<!-- Search -->
		<div class="k-scopebar__item k-scopebar__search">
			<div class="k-search__container k-search__container--has-both-buttons">
				<input class="k-search__field" type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" />
				<button type="submit" class="k-search__button-search" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>">
					<span class="k-icon-magnifying-glass"></span>
				</button>
				<button type="button" class="k-search__button-empty" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_CLEAR'); ?>" onclick="document.id('filter_search').value='';this.form.submit();">
					<span>X</span>
				</button>
			</div>
		</div><!-- .k-scopebar__search -->

	</div><!-- .k-scopebar -->

	<!-- Table -->
	<div class="k-table-container">
		<div class="k-table">
			<table class="table--fixed footable select-rows" id="contentList">
				<thead>
					<tr>
						<th width="1%">
							<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
						</th>
						<th width="1%">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
						<th width="1%"></th>
						<th data-toggle="true">
							<?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
						</th>
						<th data-hide="phone,tablet">
							<?php echo JHtml::_('grid.sort', 'COM_LANGUAGES_HEADING_TITLE_NATIVE', 'a.title_native', $listDirn, $listOrder); ?>
						</th>
						<th width="5%" data-hide="phone,tablet">
							<?php echo JHtml::_('grid.sort', 'COM_LANGUAGES_FIELD_LANG_TAG_LABEL', 'a.lang_code', $listDirn, $listOrder); ?>
						</th>
						<th width="5%" data-hide="phone,tablet">
							<?php echo JHtml::_('grid.sort', 'COM_LANGUAGES_FIELD_LANG_CODE_LABEL', 'a.sef', $listDirn, $listOrder); ?>
						</th>
						<th width="5%" data-hide="phone,tablet">
							<?php echo JHtml::_('grid.sort', 'COM_LANGUAGES_HEADING_LANG_IMAGE', 'a.image', $listDirn, $listOrder); ?>
						</th>
						<th width="5%" data-hide="phone,tablet">
							<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ACCESS', 'a.access', $listDirn, $listOrder); ?>
						</th>
						<th width="5%" data-hide="phone,tablet">
							<?php echo JHtml::_('grid.sort', 'COM_LANGUAGES_HOMEPAGE', '', $listDirn, $listOrder); ?>
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
						<td>
							<?php if ($canChange) :
								$disableClassName = '';
								$disabledLabel	  = '';

								if (!$saveOrder) :
									$disabledLabel    = JText::_('JORDERINGDISABLED');
									$disableClassName = 'inactive tip-top';
								endif; ?>
								<span class="sortable-handler hasTooltip <?php echo $disableClassName; ?>" title="<?php echo $disabledLabel; ?>">
									<i class="icon-menu"></i>
								</span>
								<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering; ?>" class="width-20 text-area-order " />
							<?php else : ?>
								<span class="sortable-handler inactive" >
									<i class="icon-menu"></i>
								</span>
							<?php endif; ?>
						</td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $item->lang_id); ?>
						</td>
						<td class="k-table-data-button--override k-table-data--center">
							<?php echo JHtml::_('jgrid.published', $item->published, $i, 'languages.', $canChange); ?>
						</td>
						<td>
							<span class="editlinktip hasTooltip" title="<?php echo JHtml::tooltipText(JText::_('JGLOBAL_EDIT_ITEM'), $item->title, 0); ?>">
							<?php if ($canEdit) : ?>
								<a href="<?php echo JRoute::_('index.php?option=com_languages&task=language.edit&lang_id='.(int) $item->lang_id); ?>">
									<?php echo $this->escape($item->title); ?></a>
							<?php else : ?>
									<?php echo $this->escape($item->title); ?>
							<?php endif; ?>
							</span>
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
							<?php echo $this->escape($item->image); ?>&nbsp;<?php echo JHtml::_('image', 'mod_languages/'.$item->image.'.gif', $item->image, array('title' => $item->image), true); ?>
						</td>
						<td>
							<?php echo $this->escape($item->access_level); ?>
						</td>
						<td>
							<?php if ($item->home == '1') : ?>
								<?php echo JText::_('JYES');?>
							<?php else:?>
								<?php echo JText::_('JNO');?>
							<?php endif;?>
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

