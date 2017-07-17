<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$data = $displayData;

// Check for show on fields.
$filters = $data['view']->filterForm->getGroup('filter');
foreach ($filters as $field)
{
	if ($showonstring = $field->getAttribute('showon'))
	{
		$showonarr = array();
		foreach (preg_split('%\[AND\]|\[OR\]%', $showonstring) as $showonfield)
		{
			$showon   = explode(':', $showonfield, 2);
			$showonarr[] = array(
				'field'  => $showon[0],
				'values' => explode(',', $showon[1]),
				'op'     => (preg_match('%\[(AND|OR)\]' . $showonfield . '%', $showonstring, $matches)) ? $matches[1] : ''
			);
		}
		$data['view']->filterForm->setFieldAttribute($field->fieldname, 'dataShowOn', json_encode($showonarr), $field->group);
	}
}

// Load the form filters
$filters = $data['view']->filterForm->getGroup('filter');
?>

<div class="k-dynamic-content-holder">
    <div class="k-js-filters">
        <?php if ($filters) : ?>
            <?php foreach ($filters as $fieldName => $field) : ?>
                <?php if ($fieldName != 'filter_search') : ?>
                    <div data-filter data-title="<?php echo (string) $field->title; ?>">
                        <?php echo $field->input; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php
        if ($data['view'] instanceof TemplatesViewStyles || $data['view'] instanceof TemplatesViewTemplates) : ?>
            <?php $clientIdField = $data['view']->filterForm->getField('client_id'); ?>
            <div data-filter data-title="<?php echo (string) $clientIdField->title; ?>">
                <div class="js-stools-field-filter js-stools-client_id">
                    <?php echo $clientIdField->input; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="k-scopebar__item--filters">
    <div class="k-scopebar__filters-content">
        <div class="k-scopebar__filters k-js-filter-container">
            <div style="display: none;" class="k-scopebar__item--filter k-scopebar-dropdown k-js-filter-prototype k-js-dropdown">
                <button type="button" class="k-scopebar-dropdown__button k-js-dropdown-button">
                    <span class="k-scopebar__item--filter__title k-js-dropdown-title"></span>
                    <span class="k-scopebar__item--filter__icon k-icon-chevron-bottom" aria-hidden="true"></span>
                    <div class="k-scopebar__item__label k-js-dropdown-label"></div>
                </button>
                <div class="k-scopebar-dropdown__body k-js-dropdown-body">
                    <div class="k-scopebar-dropdown__body__buttons">
                        <button type="button" class="k-button k-button--default k-js-clear-filter">Clear</button>
                        <button type="button" class="k-button k-button--primary k-js-apply-filter">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
