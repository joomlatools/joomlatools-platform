<?php
defined('JPATH_BASE') or die;

$data = $displayData;
?>

<!-- Pagination -->
<div class="k-table-pagination">

    <div class="k-pagination">

        <!-- Filters -->
        <?php echo JLayoutHelper::render('joomla.searchtools.default.list', array('view' => $data['view'])); ?>

        <!-- Pages -->
        <?php echo $displayData['pages'] ?>

    </div>

</div><!-- .k-table-pagination -->
