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
        <div data-filter data-title="Status" data-count="0">
            <select class="k-js-select2" name="enabled" data-placeholder="- Select -">
                <option value="" class="level1">- Select -</option>
                <option value="1" class="level1">Published</option>
                <option value="0" class="level1">Unpublished</option>
            </select>
        </div>
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
        </div><!-- .k-scopebar__filters -->

        <?php if ( 1 == 1 ): ?>
<?php if ($filters) : ?>
	<?php foreach ($filters as $fieldName => $field) : ?>
		<?php if ($fieldName != 'filter_search') : ?>
			<?php
			$showOn = '';
			if ($showOnData = $field->getAttribute('dataShowOn'))
			{
				JHtml::_('jquery.framework');
				JHtml::_('script', 'jui/cms.js', false, true);
				$showOn = " data-showon='" . $showOnData . "'";
			}
			?>
			<div class="js-stools-field-filter"<?php echo $showOn; ?>>
				<?php echo $field->input; ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
<?php endif; ?>


</div>
</div>

<!-- Temporary -->
<style type="text/css">
    .js-stools-field-filter {
        display: inline-block;
    }
</style>
