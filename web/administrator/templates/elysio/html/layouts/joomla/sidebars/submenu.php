<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

?>

<?php if ($displayData->displayMenu) : ?>
<div class="k-sidebar__navigation">
	<ul id="submenu" class="k-navigation">
		<?php foreach ($displayData->list as $item) :
		if (isset ($item[2]) && $item[2] == 1) : ?>
			<li class="k-is-active">
		<?php else : ?>
			<li>
		<?php endif;
		if ($displayData->hide) : ?>
			<a class="nolink"><?php echo $item[0]; ?></a>
		<?php else :
			if (strlen($item[1])) : ?>
				<a href="<?php echo JFilterOutput::ampReplace($item[1]); ?>"><?php echo $item[0]; ?></a>
			<?php else : ?>
				<?php echo $item[0]; ?>
			<?php endif;
		endif; ?>
		</li>
		<?php endforeach; ?>
	</ul>
</div><!-- .k-sidebar__navigation -->
<?php endif; ?>

<?php if ($displayData->displayFilters) : ?>
<div class="k-sidebar-item k-sidebar-item--flex">
	<div class="k-sidebar-item__header"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></div>
    <form class="k-sidebar-item__content" action="<?php echo JRoute::_($action); ?>" method="post">
        <?php foreach ($displayData->filters as $filter) : ?>
            <div class="form-group">
                <label for="<?php echo $filter['name']; ?>" class="element-invisible"><?php echo $filter['label']; ?></label>
                <select name="<?php echo $filter['name']; ?>" id="<?php echo $filter['name']; ?>" class="form-control" onchange="this.form.submit()">
                    <?php if (!$filter['noDefault']) : ?>
                        <option value=""><?php echo $filter['label']; ?></option>
                    <?php endif; ?>
                    <?php echo $filter['options']; ?>
                </select>
            </div>
        <?php endforeach; ?>
    </form>
</div><!-- .k-sidebar__item -->
<?php endif; ?>
