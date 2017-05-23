<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_menus
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

$uri       = JUri::getInstance();
$return    = base64_encode($uri);
$user      = JFactory::getUser();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$modMenuId = (int) $this->get('ModMenuId');

$script = array();
$script[] = "jQuery(document).ready(function() {";

foreach ($this->items as $item) :
    if ($user->authorise('core.edit', 'com_menus')) :
        $script[] = '	function jSelectPosition_' . $item->id . '(name) {';
        $script[] = '		document.getElementById("' . $item->id . '").value = name;';
        $script[] = '		jQuery(".modal").modal("hide");';
        $script[] = '	};';
    endif;
endforeach;

$script[] = '	jQuery(".modal").on("hidden", function () {';
$script[] = '		setTimeout(function(){';
$script[] = '			window.parent.location.reload();';
$script[] = '		},1000);';
$script[] = '	});';
$script[] = "});";

JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'submenu');
?>

<!-- Form -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_menus&view=menus');?>" method="post" name="adminForm" id="adminForm">

    <!-- Scopebar -->
    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this, 'options' => array('filterButton' => false))); ?>

    <!-- Table -->
    <div class="k-table-container">
        <div class="k-table">
            <table class="k-js-fixed-table-header k-js-responsive-table">
                <thead>
                <tr>
                    <th width="1%" class="k-table-data--form">
                        <?php echo JHtml::_('grid.checkall'); ?>
                    </th>
                    <th>
                        <?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
                    </th>
                    <th>
                        <?php echo JText::_('COM_MENUS_HEADING_LINKED_MODULES'); ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->items as $i => $item) : ?>
                    <tr>
                        <td class="k-table-data--form">
                            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                        </td>
                        <td class="k-table-data--ellipsis">
                            <a href="<?php echo JRoute::_('index.php?option=com_menus&view=items&menutype='.$item->menutype) ?> ">
                                <?php echo $this->escape($item->title); ?></a>
                            <small>(<span><?php echo JText::_('COM_MENUS_MENU_MENUTYPE_LABEL') ?></span>
                                <?php if ($canEdit) : ?>
                                    <?php echo '<a href="'.JRoute::_('index.php?option=com_menus&task=menu.edit&id='.$item->id).' title='.$this->escape($item->description).'">'.
                                        $this->escape($item->menutype).'</a>'; ?>)
                                <?php else : ?>
                                    <?php echo $this->escape($item->menutype)?>)
                                <?php endif; ?>
                            </small>
                        </td>
                        <td>
                            <?php if (isset($this->modules[$item->menutype])) : ?>
                                <div class="btn-group">
                                    <a href="#" class="k-button k-button--default k-button--small dropdown-toggle" data-toggle="dropdown">
                                        <?php echo JText::_('COM_MENUS_MODULES') ?>
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php foreach ($this->modules[$item->menutype] as &$module) : ?>
                                            <li>
                                                <?php if ($canEdit) : ?>
                                                    <a class="small modal" href="<?php echo JRoute::_('index.php?option=com_modules&task=module.edit&id='.$module->id.'&return='.$return.'&tmpl=component&layout=modal');?>" rel="{handler: 'iframe', size: {x: 1024, y: 450}, onClose: function() {window.location.reload()}}" title="<?php echo JText::_('COM_MENUS_EDIT_MODULE_SETTINGS');?>">
                                                        <?php echo JText::sprintf('COM_MENUS_MODULE_ACCESS_POSITION', $this->escape($module->title), $this->escape($module->access_title), $this->escape($module->position)); ?></a>
                                                <?php else :?>
                                                    <?php echo JText::sprintf('COM_MENUS_MODULE_ACCESS_POSITION', $this->escape($module->title), $this->escape($module->access_title), $this->escape($module->position)); ?>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php elseif ($modMenuId) : ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_modules&task=module.add&eid=' . $modMenuId . '&params[menutype]='.$item->menutype); ?>">
                                    <?php echo JText::_('COM_MENUS_ADD_MENU_MODULE'); ?></a>
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

            <!-- Pages -->
            <?php echo $this->pagination->getListFooter(); ?>

            <!-- Filters -->
            <?php
            $data = array('view' => $this, 'options' => array('filterButton' => false));
            echo JLayoutHelper::render('joomla.searchtools.default.list', $data);
            ?>

        </div><!-- .k-table-pagination -->

    </div><!-- .k-table-container -->

</form><!-- .k-component -->
