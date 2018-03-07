<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_templates
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

$user      = JFactory::getUser();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<?php JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'sidebar'); ?>

<!-- Component -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_templates&view=styles'); ?>" method="post" name="adminForm" id="adminForm">

    <?php // Scopebar ?>
    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

    <!-- Table -->
    <div class="k-table-container">
        <div class="k-table">
            <table class="k-js-responsive-table">
                <thead>
                    <tr>
                        <th width="1%" class="k-table-data--form">
                            <?php echo JHtml::_('grid.checkall'); ?>
                        </th>
                        <th width="1%" class="k-table-data--toggle" data-toggle="true"></th>
                        <th>
                            <?php echo JHtml::_('grid.sort', 'COM_TEMPLATES_HEADING_STYLE', 'a.title', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone">
                            <?php echo JHtml::_('grid.sort', 'COM_TEMPLATES_HEADING_DEFAULT', 'a.home', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JText::_('COM_TEMPLATES_HEADING_ASSIGNED'); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('grid.sort', 'JCLIENT', 'a.client_id', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('grid.sort', 'COM_TEMPLATES_HEADING_TEMPLATE', 'a.template', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->items as $i => $item) :
                        $canCreate = $user->authorise('core.create',     'com_templates');
                        $canEdit   = $user->authorise('core.edit',       'com_templates');
                        $canChange = $user->authorise('core.edit.state', 'com_templates');
                    ?>
                    <tr>
                        <td>
                            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                        </td>
                        <td class="k-table-data--toggle"></td>
                        <td>
                            <?php if ($this->preview && $item->client_id == '0') : ?>
                                <a target="_blank" href="<?php echo JUri::root() . 'index.php?tp=1&templateStyle='.(int) $item->id ?>" class="jgrid">
                                <i class="icon-eye-open hasTooltip" title="<?php echo JHtml::tooltipText(JText::_('COM_TEMPLATES_TEMPLATE_PREVIEW'), $item->title, 0); ?>" ></i></a>
                            <?php elseif ($item->client_id == '1') : ?>
                                <i class="icon-eye-close disabled hasTooltip" title="<?php echo JHtml::tooltipText('COM_TEMPLATES_TEMPLATE_NO_PREVIEW_ADMIN'); ?>" ></i>
                            <?php else: ?>
                                <i class="icon-eye-close disabled hasTooltip" title="<?php echo JHtml::tooltipText('COM_TEMPLATES_TEMPLATE_NO_PREVIEW'); ?>" ></i>
                            <?php endif; ?>
                            <?php if ($canEdit) : ?>
                            <a href="<?php echo JRoute::_('index.php?option=com_templates&task=style.edit&id=' . (int) $item->id); ?>">
                                <?php echo $this->escape($item->title);?></a>
                            <?php else : ?>
                                <?php echo $this->escape($item->title);?>
                            <?php endif; ?>
                        </td>
                        <td class="k-table-data-icon k-table-data--center">
                            <?php if ($item->home == '0' || $item->home == '1'):?>
                                <?php echo JHtml::_('jgrid.isdefault', $item->home != '0', $i, 'styles.', $canChange && $item->home != '1');?>
                            <?php elseif ($canChange):?>
                                <a href="<?php echo JRoute::_('index.php?option=com_templates&task=styles.unsetDefault&cid[]=' . $item->id . '&' . JSession::getFormToken() . '=1');?>">
                                    <?php echo JHtml::_('image', 'mod_languages/' . $item->image . '.gif', $item->language_title, array('title' => JText::sprintf('COM_TEMPLATES_GRID_UNSET_LANGUAGE', $item->language_title)), true);?>
                                </a>
                            <?php else:?>
                                <?php echo JHtml::_('image', 'mod_languages/' . $item->image . '.gif', $item->language_title, array('title' => $item->language_title), true);?>
                            <?php endif;?>
                        </td>
                        <td>
                            <?php if ($item->assigned > 0) : ?>
                                <i class="k-icon-check tip hasTooltip" title="<?php echo JHtml::tooltipText(JText::plural('COM_TEMPLATES_ASSIGNED', $item->assigned), '', 0); ?>"></i>
                            <?php else : ?>
                                &#160;
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $item->client_id == 0 ? JText::_('JSITE') : JText::_('JADMINISTRATOR'); ?>
                        </td>
                        <td>
                            <a href="<?php echo JRoute::_('index.php?option=com_templates&view=template&id=' . (int) $item->e_id); ?>  ">
                                <?php echo ucfirst($this->escape($item->template));?>
                            </a>
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
