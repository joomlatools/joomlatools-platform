<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$data = $displayData;

// Receive overridable options
$data['options'] = !empty($data['options']) ? $data['options'] : array();

if (is_array($data['options']))
{
	$data['options'] = new JRegistry($data['options']);
}

// Options
$filterButton = $data['options']->get('filterButton', true);
$searchButton = $data['options']->get('searchButton', true);

$filters = $data['view']->filterForm->getGroup('filter');
?>

<!-- Search -->
<div class="k-scopebar__item k-scopebar__search">
	<?php if (!empty($filters['filter_search'])) : ?>
		<?php if ($searchButton) : ?>
		<div class="k-search__container k-search__container--has-both-buttons">
			<label for="filter_search" class="visually-hidden"><?php echo JText::_('JSEARCH_FILTER'); ?></label>
			<?php echo $filters['filter_search']->input; ?>
			<button type="submit" class="k-search__button-search">
				<span class="k-icon-magnifying-glass"></span>
			</button>
			<button type="button" class="k-search__button-empty" onclick="document.id('filter_search').value='';this.form.submit();">
				<span>X</span>
			</button>
		</div>
		<?php endif; ?>
	<?php endif; ?>
</div><!-- .k-scopebar__search -->
