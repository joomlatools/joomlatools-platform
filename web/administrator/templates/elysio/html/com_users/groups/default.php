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

JText::script('COM_USERS_GROUPS_CONFIRM_DELETE');

JFactory::getDocument()->addScriptDeclaration('
		Joomla.submitbutton = function(task) {
			if (task == "groups.delete") {
				var i, cids = document.getElementsByName("cid[]");
				for (i = 0; i < cids.length; i++) {
					if (cids[i].checked && cids[i].parentNode.getAttribute("data-usercount") != 0) {
						if (confirm(Joomla.JText._("COM_USERS_GROUPS_CONFIRM_DELETE"))) {
							Joomla.submitform(task);
						}
						return false;
					}
				}
			}

			Joomla.submitform(task);
			return false;
		};
');
?>

<?php JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'sidebar'); ?>

<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_users&view=groups');?>" method="post" name="adminForm" id="adminForm">

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
                            <?php echo JHtml::_('searchtools.sort', 'COM_USERS_HEADING_GROUP_TITLE', 'a.title', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <i class="icon-publish hasTooltip" title="<?php echo JText::_('COM_USERS_COUNT_ENABLED_USERS'); ?>"></i>
                            <span class="hidden-phone"><?php echo JText::_('COM_USERS_COUNT_ENABLED_USERS'); ?></span>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <i class="icon-unpublish hasTooltip" title="<?php echo JText::_('COM_USERS_COUNT_DISABLED_USERS'); ?>"></i>
                            <span class="hidden-phone"><?php echo JText::_('COM_USERS_COUNT_DISABLED_USERS'); ?></span>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                        </th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($this->items as $i => $item) :
					$canCreate = $user->authorise('core.create', 'com_users');
					$canEdit   = $user->authorise('core.edit',    'com_users');

					// If this group is super admin and this user is not super admin, $canEdit is false
					if (!$user->authorise('core.admin') && (JAccess::checkGroup($item->id, 'core.admin')))
					{
						$canEdit = false;
					}
					$canChange	= $user->authorise('core.edit.state',	'com_users');
				?>
					<tr>
						<td class="k-table-data--form">
							<?php if ($canEdit) : ?>
								<?php echo JHtml::_('grid.id', $i, $item->id); ?>
							<?php endif; ?>
						</td>
                        <td>
                            <?php echo JLayoutHelper::render('joomla.html.treeprefix', array('level' => $item->level + 1)); ?>
                            <?php if ($canEdit) : ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_users&task=group.edit&id=' . $item->id); ?>">
                                    <?php echo $this->escape($item->title); ?></a>
                            <?php else : ?>
                                <?php echo $this->escape($item->title); ?>
                            <?php endif; ?>
                            <?php if (JDEBUG) : ?>
                                <small>
                                    <a href="<?php echo JRoute::_('index.php?option=com_users&view=debuggroup&group_id=' . (int) $item->id); ?>">
                                        <?php echo JText::_('COM_USERS_DEBUG_GROUP'); ?>
                                    </a>
                                </small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="label <?php if ($item->count_enabled > 0) echo "label-success"; ?>" href="<?php echo JRoute::_('index.php?option=com_users&view=users&filter[group_id]=' . (int) $item->id . '&filter[state]=0'); ?>">
                                <?php echo $item->count_enabled; ?>
                            </a>
                        </td>
                        <td>
                            <a class="label <?php if ($item->count_disabled > 0) echo "label-important"; ?>" href="<?php echo JRoute::_('index.php?option=com_users&view=users&filter[group_id]=' . (int) $item->id . '&filter[state]=1'); ?>">
                                <?php echo $item->count_disabled; ?>
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
