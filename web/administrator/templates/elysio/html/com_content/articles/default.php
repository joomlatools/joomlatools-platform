<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

$app		= JFactory::getApplication();
$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$archived	= $this->state->get('filter.published') == 2 ? true : false;
$trashed	= $this->state->get('filter.published') == -2 ? true : false;
$saveOrder	= $listOrder == 'a.ordering';
$menuTypeId = (int) $this->state->get('menutypeid');
$menuType   = (string) $app->getUserState('com_menus.items.menutype', '', 'string');

if ($saveOrder && $menuType)
{
	$saveOrderingUrl = 'index.php?option=com_content&task=articles.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}

$sortFields = $this->getSortFields();
$assoc		= JLanguageAssociations::isEnabled();
?>

<?php JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'submenu'); ?>

<!-- Component -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_content&view=articles'); ?>" method="post" name="adminForm" id="adminForm">

    <!-- Scopebar -->
    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this), null, array('debug' => false)); ?>

    <!-- Onboarding -->
    <?php echo JLayoutHelper::render('elysio.onboarding', array('items' => $this->items, 'type' => 'article')); ?>

    <!-- Table -->
    <div class="k-table-container<?php echo (!$this->items) ? ' k-hidden' : '' ?>">
        <div class="k-table">
            <table class="k-js-responsive-table" id="itemList">
				<thead>
					<tr>
						<th width="1%" class="k-table-data--icon">
							<?php echo JHtml::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'k-icon-move'); ?>
						</th>
                        <th width="1%" class="k-table-data--form">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
                        <th width="1%" class="k-table-data--toggle" data-toggle="true"></th>
						<th width="1%">
							<?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
						</th>
						<th>
							<?php echo JHtml::_('searchtools.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
						</th>
						<th data-hide="phone">
							<?php echo JHtml::_('searchtools.sort',  'JGRID_HEADING_ACCESS', 'a.access', $listDirn, $listOrder); ?>
						</th>
					<?php if ($assoc) : ?>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort', 'COM_CONTENT_HEADING_ASSOCIATION', 'association', $listDirn, $listOrder); ?>
						</th>
					<?php endif;?>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort',  'JAUTHOR', 'a.created_by', $listDirn, $listOrder); ?>
						</th>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_LANGUAGE', 'language', $listDirn, $listOrder); ?>
						</th>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort', 'JDATE', 'a.created', $listDirn, $listOrder); ?>
						</th>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort', 'JGLOBAL_HITS', 'a.hits', $listDirn, $listOrder); ?>
						</th>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
						</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($this->items as $i => $item) :
					$item->max_ordering = 0; //??
					$ordering   = ($listOrder == 'a.ordering');
					$canCreate  = $user->authorise('core.create',     'com_content.category.'.$item->catid);
					$canEdit    = $user->authorise('core.edit',       'com_content.article.'.$item->id);
					$canCheckin = $item->checked_out == $userId || $item->checked_out == 0;
					$canEditOwn = $user->authorise('core.edit.own',   'com_content.article.'.$item->id) && $item->created_by == $userId;
					$canChange  = $user->authorise('core.edit.state', 'com_content.article.'.$item->id) && $canCheckin;
					?>
					<tr sortable-group-id="<?php echo $item->catid; ?>">
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
                                <input type="text" style="display:none" name="order[]" size="5" value="<?php echo $orderkey + 1;?>" />
							<?php endif; ?>
						</td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $item->id); ?>
						</td>
                        <td class="k-table-data--toggle"></td>
						<td>
							<div class="btn-group">
								<?php echo JHtml::_('jgrid.published', $item->state, $i, 'articles.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
								<?php echo JHtml::_('contentadministrator.featured', $item->featured, $i, $canChange); ?>
								<?php
								// Create dropdown items
								$action = $archived ? 'unarchive' : 'archive';
								JHtml::_('actionsdropdown.' . $action, 'cb' . $i, 'articles');

								$action = $trashed ? 'untrash' : 'trash';
								JHtml::_('actionsdropdown.' . $action, 'cb' . $i, 'articles');

								// Render dropdown list
								echo JHtml::_('actionsdropdown.render', $this->escape($item->title));
								?>
							</div>
						</td>
						<td>
                            <?php if ($item->checked_out) : ?>
                                <?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'articles.', $canCheckin); ?>
                            <?php endif; ?>
                            <?php if ($item->language == '*'):?>
                                <?php $language = JText::alt('JALL', 'language'); ?>
                            <?php else:?>
                                <?php $language = $item->language_title ? $this->escape($item->language_title) : JText::_('JUNDEFINED'); ?>
                            <?php endif;?>
                            <?php if ($canEdit || $canEditOwn) : ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_content&task=article.edit&id=' . $item->id); ?>" title="<?php echo JText::_('JACTION_EDIT'); ?>">
                                    <?php echo $this->escape($item->title); ?></a>
                            <?php else : ?>
                                <span title="<?php echo JText::sprintf('JFIELD_ALIAS_LABEL', $this->escape($item->alias)); ?>"><?php echo $this->escape($item->title); ?></span>
                            <?php endif; ?>
                            <span class="small">
                                <?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($item->alias)); ?>
                            </span>
                            <div class="small">
                                <?php echo JText::_('JCATEGORY') . ": " . $this->escape($item->category_title); ?>
                            </div>
						</td>
						<td>
							<?php echo $this->escape($item->access_level); ?>
						</td>
						<?php if ($assoc) : ?>
						<td>
							<?php if ($item->association) : ?>
								<?php echo JHtml::_('contentadministrator.association', $item->id); ?>
							<?php endif; ?>
						</td>
						<?php endif;?>
						<td>
							<?php if ($item->created_by_alias) : ?>
								<a href="<?php echo JRoute::_('index.php?option=com_users&task=user.edit&id='.(int) $item->created_by); ?>" title="<?php echo JText::_('JAUTHOR'); ?>">
								<?php echo $this->escape($item->author_name); ?></a>
								<p class="smallsub"> <?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($item->created_by_alias)); ?></p>
							<?php else : ?>
								<a href="<?php echo JRoute::_('index.php?option=com_users&task=user.edit&id='.(int) $item->created_by); ?>" title="<?php echo JText::_('JAUTHOR'); ?>">
								<?php echo $this->escape($item->author_name); ?></a>
							<?php endif; ?>
						</td>
						<td>
							<?php if ($item->language == '*'):?>
								<?php echo JText::alt('JALL', 'language'); ?>
							<?php else:?>
								<?php echo $item->language_title ? $this->escape($item->language_title) : JText::_('JUNDEFINED'); ?>
							<?php endif;?>
						</td>
						<td class="k-table-data--nowrap">
							<?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC4')); ?>
						</td>
						<td>
							<?php echo (int) $item->hits; ?>
						</td>
						<td>
							<?php echo (int) $item->id; ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
        </div><!-- .k-table -->

        <!-- Pagination -->
        <?php echo JLayoutHelper::render('elysio.pagination', array('view' => $this, 'pages' => $this->pagination->getListFooter())); ?>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>

    </div><!-- .k-table-container -->

</form><!-- .k-component -->

<div class="k-dynamic-content-holder">
    <?php //Load the batch processing form. ?>
    <?php echo $this->loadTemplate('batch'); ?>

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
</div>
