<?php
defined('JPATH_BASE') or die;

$canChange = $displayData['canChange'];
$saveOrder = $displayData['saveOrder'];
$value     = $displayData['value'];
?>

<td>
    <?php
    $iconClass = '';

    if (!$canChange)
    {
        $iconClass = ' inactive';
    }
    elseif (!$saveOrder)
    {
        $iconClass = ' inactive tip-top hasTooltip" title="' . JHtml::tooltipText('JORDERINGDISABLED');
    }
    ?>
    <?php if ($canChange && $saveOrder) : ?>
        <span class="sortable-handler<?php echo $iconClass ?>">
            <span class="k-positioner k-is-active"></span>
        </span>
        <input type="text" style="display:none" name="order[]" size="5" value="<?php echo $value; ?>" />
    <?php else : ?>
        <span class="sortable-handler<?php echo $iconClass ?>">
            <span class="k-positioner" data-k-tooltip="{&quot;container&quot;:&quot;.k-ui-container&quot;}" data-original-title="Please order by this column first by clicking the column title"></span>
        </span>
    <?php endif; ?>
</td>