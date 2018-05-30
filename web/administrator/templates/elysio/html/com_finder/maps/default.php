<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_finder
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

JHtml::_('formbehavior.chosen', 'select');
JHtml::_('bootstrap.tooltip');

$listOrder     = $this->escape($this->state->get('list.ordering'));
$listDirn      = $this->escape($this->state->get('list.direction'));
$lang          = JFactory::getLanguage();
$branchFilter  = $this->escape($this->state->get('filter.branch'));
$colSpan       = $branchFilter ? 5 : 6;
JText::script('COM_FINDER_MAPS_CONFIRM_DELETE_PROMPT');

JFactory::getDocument()->addScriptDeclaration('
	Joomla.submitbutton = function(pressbutton)
	{
		if (pressbutton == "map.delete")
		{
			if (confirm(Joomla.JText._("COM_FINDER_MAPS_CONFIRM_DELETE_PROMPT")))
			{
				Joomla.submitform(pressbutton);
			}
			else
			{
				return false;
			}
		}
		Joomla.submitform(pressbutton);
	};
');
?>

<?php JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'sidebar'); ?>

<!-- Component -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_finder&view=maps'); ?>" method="post" name="adminForm" id="adminForm">

    <!-- Scopebar -->
    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this), null, array('debug' => false)); ?>

    <!-- Onboarding -->
    <?php echo JLayoutHelper::render('elysio.onboarding', array('text' => JText::_('COM_FINDER_MAPS_NO_CONTENT'), 'displayButton' => false)); ?>

    <!-- Table -->
    <div class="k-table-container<?php echo (!$this->items) ? ' k-hidden' : '' ?>">
        <div class="k-table">
            <table class="k-js-responsive-table" id="itemList">
                <thead>
                    <tr>
                        <th width="1%" class="k-table-data--form">
                            <?php echo JHtml::_('grid.checkall'); ?>
                        </th>
                        <th width="1%" class="k-table-data--toggle" data-toggle="true"></th>
                        <th width="1%">
                            <?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
                        </th>
                        <th>
                            <?php echo JHtml::_('searchtools.sort', 'JGLOBAL_TITLE', 'd.branch_title', $listDirn, $listOrder); ?>
                        </th>
                        <?php if (!$branchFilter) : ?>
                        <th width="1%" data-hide="phone,tablet">
                            <?php echo JText::_('COM_FINDER_HEADING_CHILDREN'); ?>
                        </th>
                        <?php endif; ?>
                        <th width="1%" data-hide="phone,tablet">
                            <i class="icon-publish"></i>
                            <span class="hidden-phone"><?php echo JText::_('COM_FINDER_MAPS_COUNT_PUBLISHED_ITEMS'); ?></span>
                        </th>
                        <th width="1%" data-hide="phone,tablet">
                            <i class="icon-unpublish"></i>
                            <span class="hidden-phone"><?php echo JText::_('COM_FINDER_MAPS_COUNT_UNPUBLISHED_ITEMS'); ?></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $canChange = JFactory::getUser()->authorise('core.manage', 'com_finder'); ?>
                    <?php foreach ($this->items as $i => $item) : ?>
                    <tr>
                        <td>
                            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                        </td>
                        <td class="k-table-data--toggle"></td>
                        <td>
                            <?php echo JHtml::_('jgrid.published', $item->state, $i, 'maps.', $canChange, 'cb'); ?>
                        </td>
                        <td>
                        <?php
                        if (trim($item->parent_title, '**') == 'Language')
                        {
                            $title = FinderHelperLanguage::branchLanguageTitle($item->title);
                        }
                        else
                        {
                            $key = FinderHelperLanguage::branchSingular($item->title);
                            $title = $lang->hasKey($key) ? JText::_($key) : $item->title;
                        }
                        ?>
                        <?php if ((int) $item->num_children === 0) : ?>
                            <span class="gi">&mdash;</span>
                        <?php endif; ?>
                        <label for="cb<?php echo $i; ?>" style="display:inline-block;">
                            <?php echo $this->escape($title); ?>
                        </label>
                        <?php if ($this->escape(trim($title, '**')) == 'Language' && JLanguageMultilang::isEnabled()) : ?>
                            <strong><?php echo JText::_('COM_FINDER_MAPS_MULTILANG'); ?></strong>
                        <?php endif; ?>
                        </td>
                        <?php if (!$branchFilter) : ?>
                        <td>
                        <?php if ((int) $item->num_children !== 0) : ?>
                            <a href="<?php echo JRoute::_('index.php?option=com_finder&view=maps&filter[branch]=' . $item->id); ?>">
                                <span class="badge <?php if ($item->num_children > 0) echo "badge-info"; ?>"><?php echo $item->num_children; ?></span></a>
                        <?php else : ?>
                            -
                        <?php endif; ?>
                        </td>
                        <?php endif; ?>
                        <td>
                        <?php if ((int) $item->num_children === 0) : ?>
                            <a class="badge <?php if ((int) $item->count_published > 0) echo "badge-success"; ?>" title="<?php echo JText::_('COM_FINDER_MAPS_COUNT_PUBLISHED_ITEMS'); ?>" href="<?php echo JRoute::_('index.php?option=com_finder&view=index&filter[state]=1&filter[content_map]=' . $item->id); ?>">
                            <?php echo (int) $item->count_published; ?></a>
                        <?php else : ?>
                            -
                        <?php endif; ?>
                        </td>
                        <td>
                        <?php if ((int) $item->num_children === 0) : ?>
                            <a class="badge <?php if ((int) $item->count_unpublished > 0) echo "badge-important"; ?>" title="<?php echo JText::_('COM_FINDER_MAPS_COUNT_UNPUBLISHED_ITEMS'); ?>" href="<?php echo JRoute::_('index.php?option=com_finder&view=index&filter[state]=0&filter[content_map]=' . $item->id); ?>">
                            <?php echo (int) $item->count_unpublished; ?></a>
                        <?php else : ?>
                            -
                        <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- .k-table -->

        <!-- Pagination -->
        <?php echo JLayoutHelper::render('elysio.pagination', array('view' => $this, 'pages' => $this->pagination->getListFooter())); ?>

    </div><!-- .k-table-container -->

	<input type="hidden" name="task" value="display" />
	<input type="hidden" name="boxchecked" value="0" />
	<?php echo JHtml::_('form.token'); ?>

</form><!-- .k-component -->