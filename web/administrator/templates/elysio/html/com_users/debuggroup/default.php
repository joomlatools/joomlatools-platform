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
                        <?php echo JHtml::_('searchtools.sort', 'COM_USERS_HEADING_ASSET_TITLE', 'a.title', $listDirn, $listOrder); ?>
                    </th>
                    <th>
                        <?php echo JHtml::_('searchtools.sort', 'COM_USERS_HEADING_ASSET_NAME', 'a.name', $listDirn, $listOrder); ?>
                    </th>
                    <?php foreach ($this->actions as $key => $action) : ?>
                        <th width="5%">
                            <span class="hasTooltip" title="<?php echo JHtml::tooltipText($key, $action[1]); ?>"><?php echo JText::_($key); ?></span>
                        </th>
                    <?php endforeach; ?>
                    <th width="5%">
                        <?php echo JHtml::_('searchtools.sort', 'COM_USERS_HEADING_LFT', 'a.lft', $listDirn, $listOrder); ?>
                    </th>
                    <th width="1%">
                        <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->items as $i => $item) : ?>
                    <tr>
                        <td>
                            <?php echo $this->escape($item->title); ?>
                        </td>
                        <td>
                            <?php echo JLayoutHelper::render('joomla.html.treeprefix', array('level' => $item->level + 1)) . $this->escape($item->name); ?>
                        </td>
                        <?php foreach ($this->actions as $action) : ?>
                            <?php
                            $name  = $action[0];
                            $check = $item->checks[$name];
                            if ($check === true) :
                                $class  = 'k-icon-check k-icon--success';
                            elseif ($check === false) :
                                $class  = 'k-icon-x k-icon--error';
                            elseif ($check === null) :
                                $class  = 'k-icon-ban';
                            else :
                                $class  = '';
                            endif;
                            ?>
                            <td class="k-table-data--center">
                                <span class="<?php echo $class; ?>"></span>
                            </td>
                        <?php endforeach; ?>
                        <td>
                            <?php echo (int) $item->lft; ?>
                            - <?php echo (int) $item->rgt; ?>
                        </td>
                        <td>
                            <?php echo (int) $item->id; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="k-table-pagination">
            <strong>
                <?php echo JText::_('COM_USERS_DEBUG_LEGEND'); ?>
            </strong>
            <span class="k-icon-ban"></span> <?php echo JText::_('COM_USERS_DEBUG_IMPLICIT_DENY'); ?>&nbsp;
            <span class="k-icon-check k-icon--success"></span> <?php echo JText::_('COM_USERS_DEBUG_EXPLICIT_ALLOW'); ?>&nbsp;
            <span class="k-icon-x k-icon--error"></span> <?php echo JText::_('COM_USERS_DEBUG_EXPLICIT_DENY'); ?>
        </div>

        <!-- Pagination -->
        <?php echo JLayoutHelper::render('elysio.pagination', array('view' => $this, 'pages' => $this->pagination->getListFooter())); ?>

    </div>

    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <?php echo JHtml::_('form.token'); ?>

</form>

