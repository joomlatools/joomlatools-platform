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

// Set some basic options
$customOptions = array(
	'defaultLimit'        => isset($data['options']['defaultLimit']) ? $data['options']['defaultLimit'] : JFactory::getApplication()->get('list_limit', 20),
	'searchFieldSelector' => '#filter_search',
	'orderFieldSelector'  => '#list_fullordering'
);

$data['options'] = array_unique(array_merge($customOptions, $data['options']));

$formSelector = !empty($data['options']['formSelector']) ? $data['options']['formSelector'] : '#adminForm';

// Load search tools
JHtml::_('searchtools.form', $formSelector, $data['options']);
?>

<!-- Scopebar -->
<div class="k-scopebar k-js-scopebar" id="filter-bar">

    <!-- Toggle buttons -->
    <div class="k-scopebar__item k-scopebar__item--toggle-buttons">
        <button type="button" class="k-scopebar__button k-toggle-scopebar-search k-js-toggle-search">
            <span class="k-icon-magnifying-glass" aria-hidden="true">
                <span class="k-visually-hidden">Search toggle</span>
                <div class="k-js-search-count k-scopebar__item-label k-scopebar__item-label--numberless" style="display: none"></div>
            </span>
        </button>
        <button type="button" class="k-scopebar__button k-toggle-scopebar-filters k-js-toggle-filters">
            <span class="k-icon-filter" aria-hidden="true">
                <span class="k-visually-hidden">Filters toggle</span>
                <div class="k-js-filter-count k-scopebar__item-label k-scopebar__item-label--numberless"></div>
            </span>
        </button>
    </div>

    <!-- Filters -->
    <?php echo JLayoutHelper::render('joomla.searchtools.default.filters', $data); ?>

    <!-- search -->
    <?php echo JLayoutHelper::render('joomla.searchtools.default.bar', $data); ?>

</div><!-- .k-scopebar -->
