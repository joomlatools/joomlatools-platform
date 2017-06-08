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

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_users&view=debuggroup&user_id='.(int) $this->state->get('filter.user_id'));?>" method="post" name="adminForm" id="adminForm">

    <!-- Scopebar -->
    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this, 'options' => array('filterButton' => false))); ?>

    <!-- Table -->
    <div class="k-table-container">
        <div class="k-table">
            <table class="k-js-fixed-table-header k-js-responsive-table">
                <thead>
                <tr>
                    <th>
                        <?php echo JHtml::_('grid.sort', 'COM_USERS_HEADING_ASSET_TITLE', 'a.title', $listDirn, $listOrder); ?>
                    </th>
                    <th                        <?php echo JHtml::_('grid.sort', 'COM_USERS_HEADING_ASSET_NAME', 'a.name', $listDirn, $listOrder); ?>
                    </th>
                    <?php foreach ($this->actions as $key => $action) : ?>
                        <th width="5%">
                            <span class="hasTooltip" title="<?php echo JHtml::tooltipText($key, $action[1]); ?>"><?php echo JText::_($key); ?></span>
                        </th>
                    <?php endforeach; ?>
                    <th width="5%">
                        <?php echo JHtml::_('grid.sort', 'COM_USERS_HEADING_LFT', 'a.lft', $listDirn, $listOrder); ?>
                    </th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="15">
                        <?php echo JText::_('COM_USERS_DEBUG_LEGEND'); ?>
                        <span class="btn disabled btn-micro btn-warning"><i class="icon-white icon-ban-circle"></i></span> <?php echo JText::_('COM_USERS_DEBUG_IMPLICIT_DENY');?>
                        <span class="btn disabled btn-micro btn-success"><i class="icon-white icon-ok"></i></span> <?php echo JText::_('COM_USERS_DEBUG_EXPLICIT_ALLOW');?>
                        <span class="btn disabled btn-micro btn-danger"><i class="icon-white icon-remove"></i></span> <?php echo JText::_('COM_USERS_DEBUG_EXPLICIT_DENY');?>
                    </td>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($this->items as $i => $item) : ?>
                    <tr>
                        <td>
                            <?php echo $this->escape($item->title); ?>
                        </td>
                        <td class="k-table-data--nowrap">
                            <?php echo str_repeat('<span class="gi">|&mdash;</span>', $item->level) ?>
                            <?php echo $this->escape($item->name); ?>
                        </td>
                        <?php foreach ($this->actions as $action) : ?>
                            <?php
                            $name  = $action[0];
                            $check = $item->checks[$name];
                            if ($check === true) :
                                $class  = 'icon-ok';
                                $button = 'btn-success';
                            elseif ($check === false) :
                                $class  = 'icon-remove';
                                $button = 'btn-danger';
                            elseif ($check === null) :
                                $class  = 'icon-ban-circle';
                                $button = 'btn-warning';
                            else :
                                $class  = '';
                                $button = '';
                            endif;
                            ?>
                            <td class="center">
                            <span class="btn disabled btn-micro <?php echo $button; ?>">
                                <i class="icon-white <?php echo $class; ?>"></i>
                            </span>
                            </td>
                        <?php endforeach; ?>
                        <td class="k-table-data--center k-table-data--nowrap">
                            <?php echo (int) $item->lft; ?>
                            - <?php echo (int) $item->rgt; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php echo JLayoutHelper::render('elysio.pagination', array('view' => $this, 'pages' => $this->pagination->getListFooter())); ?>

    </div>

    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
    <?php echo JHtml::_('form.token'); ?>
</form>

