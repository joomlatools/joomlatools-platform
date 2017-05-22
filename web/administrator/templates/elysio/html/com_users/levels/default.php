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
$canOrder	= $user->authorise('core.edit.state', 'com_users');
$saveOrder	= $listOrder == 'a.ordering';
$sortFields = $this->getSortFields();
$saveOrder	= $listOrder == 'a.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_users&task=levels.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'levelList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
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
<form class="k-list-layout -koowa-grid" action="<?php echo JRoute::_('index.php?option=com_users&view=levels');?>" method="post" id="adminForm" name="adminForm">

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
            <table class="table--fixed footable select-rows" id="levelList">
                <thead>
                    <tr>
                        <th width="1%">
                            <?php echo JHtml::_('grid.checkall'); ?>
                        </th>
                        <th>
                            <?php echo JHtml::_('grid.sort', 'COM_USERS_HEADING_LEVEL_NAME', 'a.title', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%">
                            <?php echo JHtml::_('grid.sort', '<span class="k-icon-move"></span>', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php $count = count($this->items); ?>
                <?php foreach ($this->items as $i => $item) :
                    $ordering  = ($listOrder == 'a.ordering');
                    $canCreate = $user->authorise('core.create',     'com_users');
                    $canEdit   = $user->authorise('core.edit',       'com_users');
                    $canChange = $user->authorise('core.edit.state', 'com_users');
                    ?>
                    <tr>
                        <td>
                            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                        </td>
                        <td>
                            <?php if ($canEdit) : ?>
                            <a href="<?php echo JRoute::_('index.php?option=com_users&task=level.edit&id='.$item->id);?>">
                                <?php echo $this->escape($item->title); ?></a>
                            <?php else : ?>
                                <?php echo $this->escape($item->title); ?>
                            <?php endif; ?>
                        </td>
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
                                <span class="k-icon-move"></span>
                            </span>
                            <?php if ($canChange && $saveOrder) : ?>
                                <input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering; ?>" class="width-20 text-area-order " />
                            <?php endif; ?>
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
