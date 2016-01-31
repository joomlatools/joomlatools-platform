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

// Load the form list fields
$list = $data['view']->filterForm->getGroup('list');
?>
<?php if ($list) : ?>
	<?php foreach ($list as $fieldName => $field) : ?>
		<div style="max-width: 200px;display: inline-block">
			<?php echo $field->input; ?>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
