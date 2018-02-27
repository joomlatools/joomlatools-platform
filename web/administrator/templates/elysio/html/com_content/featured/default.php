<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_content.article');
$archived	= $this->state->get('filter.published') == 2 ? true : false;
$trashed	= $this->state->get('filter.published') == -2 ? true : false;
$saveOrder	= $listOrder == 'fp.ordering';
?>

<?php JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'submenu'); ?>

<!-- Component -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_content&view=featured'); ?>" method="post" name="adminForm" id="adminForm">

    <!-- Scopebar -->
    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this), null, array('debug' => false)); ?>

    <!-- Onboarding -->
    <?php echo JLayoutHelper::render('elysio.onboarding', array('items' => $this->items, 'type' => 'featured article', 'displayButton' => false)); ?>

    <!-- Table -->
    <div class="k-table-container<?php echo (!$this->items) ? ' k-hidden' : '' ?>">
        <div class="k-table">
            <table class="k-js-responsive-table" id="articleList">
				<thead>
					<tr>
                        <th width="1%" class="k-table-data--icon">
							<?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
						</th>
                        <th width="1%" class="k-table-data--form">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
                        <th width="1%" class="k-table-data--toggle" data-toggle="true"></th>
						<th>
							<?php echo JHtml::_('searchtools.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
						</th>
						<th width="1%" data-hide="phone">
							<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ORDERING', 'fp.ordering', $listDirn, $listOrder); ?>
							<?php if ($canOrder && $saveOrder) :?>
								<?php echo JHtml::_('grid.order', $this->items, 'filesave.png', 'featured.saveorder'); ?>
							<?php endif; ?>
						</th>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ACCESS', 'a.access', $listDirn, $listOrder); ?>
						</th>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort', 'JAUTHOR', 'a.created_by', $listDirn, $listOrder); ?>
						</th>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_LANGUAGE', 'language', $listDirn, $listOrder); ?>
						</th>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort', 'JDATE', 'a.created', $listDirn, $listOrder); ?>
						</th>
						<th width="1%" data-hide="phone,tablet">
							<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
						</th>
					</tr>
				</thead>
				<tbody>
				<?php $count = count($this->items); ?>
				<?php foreach ($this->items as $i => $item) :
					$item->max_ordering = 0;
					$ordering	= ($listOrder == 'fp.ordering');
					$assetId	= 'com_content.article.'.$item->id;
					$canCreate	= $user->authorise('core.create',     'com_content.category.'.$item->catid);
					$canEdit	= $user->authorise('core.edit',       'com_content.article.'.$item->id);
					$canCheckin	= $item->checked_out == $userId || $item->checked_out == 0;
					$canChange	= $user->authorise('core.edit.state', 'com_content.article.'.$item->id) && $canCheckin;
					?>
					<tr sortable-group-id="<?php echo $item->catid; ?>">
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
							<?php echo JHtml::_('grid.id', $i, $item->id); ?>
						</td>
                        <td class="k-table-data--toggle"></td>
						<td>
                            <?php if ($item->checked_out) : ?>
                                <?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'articles.', $canCheckin); ?>
                            <?php endif; ?>
                            <?php if ($item->language == '*') : ?>
                                <?php $language = JText::alt('JALL', 'language'); ?>
                            <?php else : ?>
                                <?php $language = $item->language_title ? $this->escape($item->language_title) : JText::_('JUNDEFINED'); ?>
                            <?php endif; ?>
                            <?php if ($canEdit) : ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_content&task=article.edit&return=featured&id=' . $item->id);?>" title="<?php echo JText::_('JACTION_EDIT'); ?>">
                                    <?php echo $this->escape($item->title); ?></a>
                            <?php else : ?>
                                <span title="<?php echo JText::sprintf('JFIELD_ALIAS_LABEL', $this->escape($item->alias)); ?>"><?php echo $this->escape($item->title); ?></span>
                            <?php endif; ?>
                            <div class="small">
                                <?php echo JText::_('JCATEGORY') . ": " . $this->escape($item->category_title); ?>
                            </div>
						</td>
						<td>
							<?php if ($canChange && $saveOrder) : ?>
								<div class="input-prepend">
									<?php if ($listDirn == 'ASC') : ?>
										<span class="add-on"><?php echo $this->pagination->orderUpIcon($i, true, 'featured.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
										<span class="add-on"><?php echo $this->pagination->orderDownIcon($i, $count, true, 'featured.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
									<?php elseif ($listDirn == 'DESC') : ?>
										<span class="add-on"><?php echo $this->pagination->orderUpIcon($i, true, 'featured.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
										<span class="add-on"><?php echo $this->pagination->orderDownIcon($i, $count, true, 'featured.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
									<?php endif; ?>
									<input type="text" name="order[]" size="5" value="<?php echo $item->ordering; ?>" class="width-20 text-area-order" />
								</div>
							<?php else : ?>
								<?php echo $item->ordering; ?>
							<?php endif; ?>
						</td>
						<td>
							<?php echo $this->escape($item->access_level); ?>
						</td>
						<td>
							<?php if ($item->created_by_alias) : ?>
								<?php echo $this->escape($item->author_name); ?>
								<p class="smallsub"> <?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($item->created_by_alias)); ?></p>
							<?php else : ?>
								<?php echo $this->escape($item->author_name); ?>
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
		<input type="hidden" name="featured" value="1" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>

	</div><!-- .k-table-container -->

</form><!-- .k-component -->
