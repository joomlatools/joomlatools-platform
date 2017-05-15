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

// Add class to input field
$filters['filter_search']->class = 'k-search__field';
?>

<?php if (!empty($filters['filter_search'])) : ?>
<!-- Search -->
<div class="k-scopebar__item k-scopebar__item--search">
    <div class="k-search k-search--has-both-buttons">
        <label for="k-search-input"><?php echo JText::_('JSEARCH_FILTER'); ?></label>
        <?php echo $filters['filter_search']->input; ?>
        <button type="submit" class="k-search__submit" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>">
            <span class="k-icon-magnifying-glass" aria-hidden="true"></span>
            <span class="k-visually-hidden">Search</span>
        </button>
        <button type="button" class="k-search__empty" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_CLEAR'); ?>" onclick="document.id('filter_search').value='';this.form.submit();">
            <span class="k-search__empty-area">
                <span class="k-icon-x" aria-hidden="true"></span>
                <span class="k-visually-hidden">Clear search</span>
            </span>
        </button>
    </div>
</div>
<?php endif; ?>

