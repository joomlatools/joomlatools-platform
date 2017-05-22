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

<!-- Pagination filters -->
<div class="k-pagination">
    <div class="k-pagination__limit">
        <?php if ($list) : ?>
            <?php foreach ($list as $fieldName => $field) : ?>
                <?php echo $field->input; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
