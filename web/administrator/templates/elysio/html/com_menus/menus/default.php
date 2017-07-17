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

    <!-- Onboarding -->
    <?php echo JLayoutHelper::render('elysio.onboarding', array('items' => $this->items, 'type' => 'menu')); ?>

    <!-- Table -->
    <div class="k-table-container<?php echo (!$this->items) ? ' k-hidden' : '' ?>">
        <div class="k-table">
            <table class="k-js-fixed-table-header k-js-responsive-table">
                <thead>
                <tr>
                    <th width="1%" class="k-table-data--form">
                        <?php echo JHtml::_('grid.checkall'); ?>
                    </th>
                    <th width="1%" class="k-table-data--toggle" data-toggle="true"></th>
                    <th>
                        <?php echo JHtml::_('searchtools.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
                    </th>
                    <th width="1%" data-hide="phone,tablet">
                        <?php echo JText::_('COM_MENUS_HEADING_PUBLISHED_ITEMS'); ?>
                    </th>
                    <th width="1%" data-hide="phone,tablet">
                        <?php echo JText::_('COM_MENUS_HEADING_UNPUBLISHED_ITEMS'); ?>
                    </th>
                    <th width="1%" data-hide="phone,tablet">
                        <?php echo JText::_('COM_MENUS_HEADING_TRASHED_ITEMS'); ?>
                    </th>
                    <th width="1%" data-hide="phone,tablet">
                        <?php echo JText::_('COM_MENUS_HEADING_LINKED_MODULES'); ?>
                    </th>
                    <th width="1%" data-hide="phone,tablet">
                        <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->items as $i => $item) :
                    $canEdit        = $user->authorise('core.edit',   'com_menus.menu.' . (int) $item->id);
                    $canManageItems = $user->authorise('core.manage', 'com_menus.menu.' . (int) $item->id);
                    ?>
                    <tr>
                        <td class="k-table-data--form">
                            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                        </td>
                        <td class="k-table-data--toggle"></td>
                        <td class="k-table-data--ellipsis">
                            <?php if ($canManageItems) : ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_menus&view=items&menutype=' . $item->menutype); ?>">
                                    <?php echo $this->escape($item->title); ?></a>
                            <?php else : ?>
                                <?php echo $this->escape($item->title); ?>
                            <?php endif; ?>
                            <small>
                                <?php echo JText::_('COM_MENUS_MENU_MENUTYPE_LABEL'); ?>:
                                <?php if ($canEdit) : ?>
                                    <a href="<?php echo JRoute::_('index.php?option=com_menus&task=menu.edit&id=' . $item->id); ?>" title="<?php echo $this->escape($item->description); ?>">
                                        <?php echo $this->escape($item->menutype); ?></a>
                                <?php else : ?>
                                    <?php echo $this->escape($item->menutype); ?>
                                <?php endif; ?>
                            </small>
                        </td>
                        <td>
                            <?php if ($canManageItems) : ?>
                                <a class="k-button k-button--default k-button--small" href="<?php echo JRoute::_('index.php?option=com_menus&view=items&menutype=' . $item->menutype . '&filter[published]=1'); ?>">
                                    <?php echo $item->count_published; ?>
                                </a>
                            <?php else : ?>
                                <?php echo $item->count_published; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($canManageItems) : ?>
                                <a class="k-button k-button--default k-button--small" href="<?php echo JRoute::_('index.php?option=com_menus&view=items&menutype=' . $item->menutype . '&filter[published]=0'); ?>">
                                    <?php echo $item->count_unpublished; ?>
                                </a>
                            <?php else : ?>
                                <?php echo $item->count_unpublished; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($canManageItems) : ?>
                                <a class="k-button k-button--default k-button--small" href="<?php echo JRoute::_('index.php?option=com_menus&view=items&menutype=' . $item->menutype . '&filter[published]=-2'); ?>">
                                    <?php echo $item->count_trashed; ?>
                                </a>
                            <?php else : ?>
                                <?php echo $item->count_trashed; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (isset($this->modules[$item->menutype])) : ?>
                                <div class="btn-group">
                                    <a href="#" class="k-button k-button--default k-button--small" data-toggle="dropdown">
                                        <?php echo JText::_('COM_MENUS_MODULES'); ?>
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php foreach ($this->modules[$item->menutype] as &$module) : ?>
                                            <li>
                                                <?php if ($canEdit) : ?>
                                                    <?php $link = JRoute::_('index.php?option=com_modules&task=module.edit&id=' . $module->id . '&return=' . $return . '&tmpl=component&layout=modal'); ?>
                                                    <a href="#moduleEdit<?php echo $module->id; ?>Modal" role="button" class="button" data-toggle="modal" title="<?php echo JText::_('COM_MENUS_EDIT_MODULE_SETTINGS'); ?>">
                                                        <?php echo JText::sprintf('COM_MENUS_MODULE_ACCESS_POSITION', $this->escape($module->title), $this->escape($module->access_title), $this->escape($module->position)); ?></a>
                                                <?php else : ?>
                                                    <?php echo JText::sprintf('COM_MENUS_MODULE_ACCESS_POSITION', $this->escape($module->title), $this->escape($module->access_title), $this->escape($module->position)); ?>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <?php foreach ($this->modules[$item->menutype] as &$module) : ?>
                                    <?php if ($canEdit) : ?>
                                        <?php $link = JRoute::_('index.php?option=com_modules&task=module.edit&id=' . $module->id . '&return=' . $return . '&tmpl=component&layout=modal'); ?>
                                        <?php echo JHtml::_(
                                            'bootstrap.renderModal',
                                            'moduleEdit' . $module->id . 'Modal',
                                            array(
                                                'title'       => JText::_('COM_MENUS_EDIT_MODULE_SETTINGS'),
                                                'backdrop'    => 'static',
                                                'keyboard'    => false,
                                                'closeButton' => false,
                                                'url'         => $link,
                                                'height'      => '400px',
                                                'width'       => '800px',
                                                'bodyHeight'  => '70',
                                                'modalWidth'  => '80',
                                                'footer'      => '<a type="button" class="k-button k-button--text" data-dismiss="modal" aria-hidden="true"'
                                                    . ' onclick="jQuery(\'#moduleEdit' . $module->id . 'Modal iframe\').contents().find(\'#closeBtn\').click();">'
                                                    . JText::_("JLIB_HTML_BEHAVIOR_CLOSE") . '</a>'
                                                    . '<button type="button" class="k-button k-button--primary" aria-hidden="true"'
                                                    . ' onclick="jQuery(\'#moduleEdit' . $module->id . 'Modal iframe\').contents().find(\'#saveBtn\').click();">'
                                                    . JText::_("JSAVE") . '</button>'
                                                    . '<button type="button" class="k-button k-button--success" aria-hidden="true"'
                                                    . ' onclick="jQuery(\'#moduleEdit' . $module->id . 'Modal iframe\').contents().find(\'#applyBtn\').click();">'
                                                    . JText::_("JAPPLY") . '</button>',
                                            )
                                        ); ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php elseif ($modMenuId) : ?>
                                <?php $link = JRoute::_('index.php?option=com_modules&task=module.add&eid=' . $modMenuId . '&params[menutype]=' . $item->menutype . '&tmpl=component&layout=modal'); ?>
                                <a class="k-button k-button--default k-button--small" data-toggle="modal" role="button" href="#moduleAddModal"><?php echo JText::_('COM_MENUS_ADD_MENU_MODULE'); ?></a>
                                <?php echo JHtml::_(
                                    'bootstrap.renderModal',
                                    'moduleAddModal',
                                    array(
                                        'title'       => JText::_('COM_MENUS_ADD_MENU_MODULE'),
                                        'backdrop'    => 'static',
                                        'keyboard'    => false,
                                        'closeButton' => false,
                                        'url'         => $link,
                                        'height'      => '400px',
                                        'width'       => '800px',
                                        'bodyHeight'  => '70',
                                        'modalWidth'  => '80',
                                        'footer'      => '<a type="button" class="k-button k-button--text" data-dismiss="modal" aria-hidden="true"'
                                            . ' onclick="jQuery(\'#moduleAddModal iframe\').contents().find(\'#closeBtn\').click();">'
                                            . JText::_("JLIB_HTML_BEHAVIOR_CLOSE") . '</a>'
                                            . '<button type="button" class="k-button k-button--primary" aria-hidden="true"'
                                            . ' onclick="jQuery(\'#moduleAddModal iframe\').contents().find(\'#saveBtn\').click();">'
                                            . JText::_("JSAVE") . '</button>'
                                            . '<button type="button" class="k-button k-button--success" aria-hidden="true"'
                                            . ' onclick="jQuery(\'#moduleAddModal iframe\').contents().find(\'#applyBtn\').click();">'
                                            . JText::_("JAPPLY") . '</button>',
                                    )
                                ); ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $item->id; ?>
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
