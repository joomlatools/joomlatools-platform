<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_modules
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

$clientId   = (int) $this->state->get('client_id', 0);
$user		= JFactory::getUser();
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder	= ($listOrder == 'a.ordering');
if ($saveOrder)
{
    $saveOrderingUrl = 'index.php?option=com_modules&task=modules.saveOrderAjax&tmpl=component';
    JHtml::_('sortablelist.sortable', 'moduleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
$colSpan = $clientId === 1 ? 9 : 10;
?>

<!-- Component -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_modules'); ?>" method="post" name="adminForm" id="adminForm">

    <!-- Scopebar -->
    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this, 'options' => array('filterButton' => false))); ?>

	<!-- Table -->
	<div class="k-table-container">
		<div class="k-table">
            <table class="k-js-responsive-table" id="moduleList">
				<thead>
					<tr>
                        <th width="1%" class="nowrap center hidden-phone">
                            <?php echo JHtml::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'k-icon-move'); ?>
                        </th>
						<th width="1%" class="k-table-data--form">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
                        <th width="1%" class="k-table-data--toggle" data-toggle="true"></th>
                        <th>
                            <?php echo JHtml::_('searchtools.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%">
                            <?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone">
                            <?php echo JHtml::_('searchtools.sort', 'COM_MODULES_HEADING_POSITION', 'a.position', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'COM_MODULES_HEADING_MODULE', 'name', $listDirn, $listOrder); ?>
                        </th>
                        <?php if ($clientId === 0) : ?>
                            <th width="1%" data-hide="phone,tablet">
                                <?php echo JHtml::_('searchtools.sort', 'COM_MODULES_HEADING_PAGES', 'pages', $listDirn, $listOrder); ?>
                            </th>
                        <?php endif; ?>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ACCESS', 'ag.title', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_LANGUAGE', 'l.title', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                        </th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($this->items as $i => $item) :
					$ordering   = ($listOrder == 'ordering');
					$canCreate  = $user->authorise('core.create',     'com_modules');
					$canEdit	= $user->authorise('core.edit',		  'com_modules.module.'.$item->id);
					$canCheckin = $item->checked_out == $user->get('id')|| $item->checked_out == 0;
					$canChange  = $user->authorise('core.edit.state', 'com_modules.module.'.$item->id) && $canCheckin;
				?>
					<tr sortable-group-id="<?php echo $item->position ? $item->position : 'none'; ?>">
                        <?php echo JLayoutHelper::render('elysio.ordering', array('canChange' => $canChange, 'saveOrder' => $saveOrder, 'value' => $item->ordering)); ?>
						<td class="k-table-data--form">
							<?php echo JHtml::_('grid.id', $i, $item->id); ?>
						</td>
                        <td class="k-table-data--toggle"></td>
                        <td>
                            <?php if (JHtml::_('grid.ischeckedout', $item)) : ?>
                                <?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'modules.', $canCheckin); ?>
                            <?php endif; ?>
                            <?php if ($canEdit) : ?>
                                <a class="hasTooltip" href="<?php echo JRoute::_('index.php?option=com_modules&task=module.edit&id=' . (int) $item->id); ?>" title="<?php echo JText::_('JACTION_EDIT'); ?>">
                                    <?php echo $this->escape($item->title); ?></a>
                            <?php else : ?>
                                <?php echo $this->escape($item->title); ?>
                            <?php endif; ?>

                            <?php if (!empty($item->note)) : ?>
                                <div class="small">
                                    <?php echo JText::sprintf('JGLOBAL_LIST_NOTE', $this->escape($item->note)); ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <?php // Check if extension is enabled ?>
                                <?php if ($item->enabled > 0) : ?>
                                    <?php echo JHtml::_('jgrid.published', $item->published, $i, 'modules.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
                                    <?php // Create dropdown items and render the dropdown list.
                                    if ($canCreate)
                                    {
                                        JHtml::_('actionsdropdown.duplicate', 'cb' . $i, 'modules');
                                    }
                                    if ($canChange)
                                    {
                                        JHtml::_('actionsdropdown.' . ((int) $item->published === -2 ? 'un' : '') . 'trash', 'cb' . $i, 'modules');
                                    }
                                    if ($canCreate || $canChange)
                                    {
                                        echo JHtml::_('actionsdropdown.render', $this->escape($item->title));
                                    }
                                    ?>
                                <?php else : ?>
                                    <?php // Extension is not enabled, show a message that indicates this. ?>
                                    <button class="btn-micro hasTooltip" title="<?php echo JText::_('COM_MODULES_MSG_MANAGE_EXTENSION_DISABLED'); ?>"><i class="icon-ban-circle"></i></button>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($item->position) : ?>
                                <span class="label label-info">
									<?php echo $item->position; ?>
								</span>
                            <?php else : ?>
                                <span class="label">
									<?php echo JText::_('JNONE'); ?>
								</span>
                            <?php endif; ?>
                        </td>
                        <td class="k-table-data--nowrap">
                            <?php echo $item->name;?>
                        </td>
                        <?php if ($clientId === 0) : ?>
                            <td>
                                <?php echo $item->pages; ?>
                            </td>
                        <?php endif; ?>
                        <td>
                            <?php echo $this->escape($item->access_level); ?>
                        </td>
                        <td>
                            <?php if ($item->language == '') : ?>
                                <?php echo JText::_('JDEFAULT'); ?>
                            <?php elseif ($item->language == '*'):?>
                                <?php echo JText::alt('JALL', 'language'); ?>
                            <?php else:?>
                                <?php echo $item->language_title ? JHtml::_('image', 'mod_languages/' . $item->language_image . '.gif', $item->language_title, array('title' => $item->language_title), true) . '&nbsp;' . $this->escape($item->language_title) : JText::_('JUNDEFINED'); ?>
                            <?php endif;?>
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

    <?php // Load the batch processing form. ?>
    <?php if ($user->authorise('core.create', 'com_modules')
        && $user->authorise('core.edit', 'com_modules')
        && $user->authorise('core.edit.state', 'com_modules')) : ?>
        <?php echo JHtml::_(
            'bootstrap.renderModal',
            'collapseModal',
            array(
                'title' => JText::_('COM_MODULES_BATCH_OPTIONS'),
                'footer' => $this->loadTemplate('batch_footer')
            ),
            $this->loadTemplate('batch_body')
        ); ?>
    <?php endif; ?>

</form><!-- .k-component -->
