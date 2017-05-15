<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_menus
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user		= JFactory::getUser();
$app		= JFactory::getApplication();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$ordering 	= ($listOrder == 'a.lft');
$canOrder	= $user->authorise('core.edit.state',	'com_menus');
$saveOrder 	= ($listOrder == 'a.lft' && strtolower($listDirn) == 'asc');

if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_menus&task=items.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'itemList', 'adminForm', strtolower($listDirn), $saveOrderingUrl, false, true);
}

$sortFields = $this->getSortFields();
$assoc		= JLanguageAssociations::isEnabled();

JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'submenu');
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

<!-- Form -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_menus&view=items');?>" method="post" name="adminForm" id="adminForm">

    <!-- Scopebar -->
    <div class="k-scopebar k-js-scopebar">
        <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this), null, array('debug' => false)); ?>

        <!-- Filters -->
        <div class="k-scopebar__item k-scopebar__item--filters">

            <div class="k-scopebar__filters-content">

                <!-- Filter -->
                <div class="k-filter-container__item" data-filter="tools">
                    <?php echo JLayoutHelper::render('joomla.searchtools.default.filters', array('view' => $this), null, array('debug' => false)); ?>
                </div><!-- k-filter-container__item -->
            </div>

        </div><!-- .k-scopebar -->

    </div><!-- .k-scopebar -->

    <!-- Table -->
    <div class="k-table-container">
        <div class="k-table">
            <table class="k-js-fixed-table-header k-js-responsive-table">
                <thead>
                    <tr>
                        <th width="1%">
                            <?php echo JHtml::_('grid.checkall'); ?>
                        </th>
                        <th width="1%">
                        </th>
                        <th data-toggle="true">
                            <?php echo JHtml::_('searchtools.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
                        </th>
                        <th data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'COM_MENUS_HEADING_HOME', 'a.home', $listDirn, $listOrder); ?>
                        </th>
                        <th data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort',  'JGRID_HEADING_ACCESS', 'a.access', $listDirn, $listOrder); ?>
                        </th>
                        <?php if ($assoc) : ?>
                        <th data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'COM_MENUS_HEADING_ASSOCIATION', 'association', $listDirn, $listOrder); ?>
                        </th>
                        <?php endif;?>
                        <th data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_LANGUAGE', 'language', $this->state->get('list.direction'), $this->state->get('list.ordering')); ?>
                        </th>
                        <th data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', '', 'a.lft', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
                        </th>
                    </tr>
                </thead>

                <tbody>
                <?php
                foreach ($this->items as $i => $item) :
                    $orderkey   = array_search($item->id, $this->ordering[$item->parent_id]);
                    $canCreate  = $user->authorise('core.create',     'com_menus');
                    $canEdit    = $user->authorise('core.edit',       'com_menus');
                    $canCheckin = $item->checked_out == $user->get('id')|| $item->checked_out == 0;
                    $canChange  = $user->authorise('core.edit.state', 'com_menus') && $canCheckin;
                    // Get the parents of item for sorting
                    if ($item->level > 1)
                    {
                        $parentsStr = "";
                        $_currentParentId = $item->parent_id;
                        $parentsStr = " ".$_currentParentId;
                        for ($j = 0; $j < $item->level; $j++)
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
                    <tr sortable-group-id="<?php echo $item->parent_id;?>" item-id="<?php echo $item->id?>" parents="<?php echo $parentsStr?>" level="<?php echo $item->level?>">
                        <td>
                            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                        </td>
                        <td class="k-table-data-button--override k-table-data--center">
                            <?php echo JHtml::_('MenusHtml.Menus.state', $item->published, $i, $canChange, 'cb'); ?>
                        </td>
                        <td class="k-table-data-button--override">
                            <?php echo str_repeat('<span class="gi">|&mdash;</span>', $item->level - 1) ?>
                            <?php if ($item->checked_out) : ?>
                                <?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'items.', $canCheckin); ?>
                            <?php endif; ?>
                            <?php if ($canEdit) : ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_menus&task=item.edit&id='.(int) $item->id);?>">
                                    <?php echo $this->escape($item->title); ?></a>
                            <?php else : ?>
                                <?php echo $this->escape($item->title); ?>
                            <?php endif; ?>
                            <span class="small">
                            <?php if ($item->type != 'url') : ?>
                                <?php if (empty($item->note)) : ?>
                                    <?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($item->alias));?>
                                <?php else : ?>
                                    <?php echo JText::sprintf('JGLOBAL_LIST_ALIAS_NOTE', $this->escape($item->alias), $this->escape($item->note));?>
                                <?php endif; ?>
                            <?php elseif ($item->type == 'url' && $item->note) : ?>
                                <?php echo JText::sprintf('JGLOBAL_LIST_NOTE', $this->escape($item->note));?>
                            <?php endif; ?>
                            </span>
                            <div class="small" title="<?php echo $this->escape($item->path);?>">
                                <?php echo str_repeat('<span class="gtr">&mdash;</span>', $item->level - 1) ?>
                                <span title="<?php echo isset($item->item_type_desc) ? htmlspecialchars($this->escape($item->item_type_desc), ENT_COMPAT, 'UTF-8') : ''; ?>">
                                    <?php echo $this->escape($item->item_type); ?></span>
                            </div>
                        </td>
                        <td class="k-table-data-button--override k-table-data--center">
                            <?php if ($item->type == 'component') : ?>
                                <?php if ($item->language == '*' || $item->home == '0'):?>
                                    <?php echo JHtml::_('jgrid.isdefault', $item->home, $i, 'items.', ($item->language != '*' || !$item->home) && $canChange);?>
                                <?php elseif ($canChange):?>
                                    <a href="<?php echo JRoute::_('index.php?option=com_menus&task=items.unsetDefault&cid[]='.$item->id.'&'.JSession::getFormToken().'=1');?>">
                                        <?php echo JHtml::_('image', 'mod_languages/' . $item->image . '.gif', $item->language_title, array('title' => JText::sprintf('COM_MENUS_GRID_UNSET_LANGUAGE', $item->language_title)), true);?>
                                    </a>
                                <?php else:?>
                                    <?php echo JHtml::_('image', 'mod_languages/' . $item->image . '.gif', $item->language_title, array('title' => $item->language_title), true);?>
                                <?php endif;?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $this->escape($item->access_level); ?>
                        </td>
                        <?php if ($assoc):?>
                        <td class="k-table-data--center">
                            <?php if ($item->association) : ?>
                                <?php echo JHtml::_('MenusHtml.Menus.association', $item->id);?>
                            <?php endif;?>
                        </td>
                        <?php endif;?>
                        <td>
                            <?php if ($item->language == ''):?>
                                <?php echo JText::_('JDEFAULT'); ?>
                            <?php elseif ($item->language == '*'):?>
                                <?php echo JText::alt('JALL', 'language'); ?>
                            <?php else:?>
                                <?php echo $item->language_title ? $this->escape($item->language_title) : JText::_('JUNDEFINED'); ?>
                            <?php endif;?>
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
                                $iconClass = ' inactive tip-top" title="' . JHtml::tooltipText('JORDERINGDISABLED');
                            }
                            ?>
                            <span class="sortable-handler<?php echo $iconClass ?>">
                                <i class="k-icon-move"></i>
                            </span>
                            <?php if ($canChange && $saveOrder) : ?>
                                <input type="text" style="display:none" name="order[]" size="5" value="<?php echo $orderkey + 1;?>" />
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- .k-table -->

        <!-- Pagination -->
        <div class="k-table-pagination">
            <?php echo $this->pagination->getListFooter(); ?>
        </div><!-- .k-table-pagination -->

        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <?php echo JHtml::_('form.token'); ?>

    </div><!-- .k-table-container -->

</form><!-- .k-list-layout -->

<?php if ($user->authorise('core.create', 'com_menus') || $user->authorise('core.edit', 'com_menus')) : ?>
    <?php echo $this->loadTemplate('batch'); ?>
<?php endif;?>