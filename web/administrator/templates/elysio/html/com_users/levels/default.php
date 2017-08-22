<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

$user       = JFactory::getUser();
$listOrder  = $this->escape($this->state->get('list.ordering'));
$listDirn   = $this->escape($this->state->get('list.direction'));
$canOrder   = $user->authorise('core.edit.state', 'com_users');
$saveOrder  = $listOrder == 'a.ordering';

if ($saveOrder)
{
    $saveOrderingUrl = 'index.php?option=com_users&task=levels.saveOrderAjax&tmpl=component';
    JHtml::_('sortablelist.sortable', 'levelList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}

?>

<?php JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'sidebar'); ?>

<!-- Form -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_users&view=levels');?>" method="post" id="adminForm" name="adminForm">

    <!-- Scopebar -->
    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this, 'options' => array('filterButton' => false))); ?>

    <!-- Onboarding -->
    <?php echo JLayoutHelper::render('elysio.onboarding', array('items' => $this->items, 'type' => 'level')); ?>

    <!-- Table -->
    <div class="k-table-container<?php echo (!$this->items) ? ' k-hidden' : '' ?>">
        <div class="k-table">
            <table class="k-js-fixed-table-header k-js-responsive-table" id="levelList">
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
                            <?php echo JHtml::_('searchtools.sort', 'COM_USERS_HEADING_LEVEL_NAME', 'a.title', $listDirn, $listOrder); ?>
                        </th>
                        <th data-hide="phone,tablet">
                            <?php echo JText::_('COM_USERS_USER_GROUPS_HAVING_ACCESS'); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
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
                                <input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering; ?>" />
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                        </td>
                        <td class="k-table-data--toggle"></td>
                        <td>
                            <?php if ($canEdit) : ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_users&task=level.edit&id=' . $item->id);?>">
                                    <?php echo $this->escape($item->title); ?></a>
                            <?php else : ?>
                                <?php echo $this->escape($item->title); ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo UsersHelper::getVisibleByGroups($item->rules); ?>
                        </td>
                        <td>
                            <?php echo (int) $item->id; ?>
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
