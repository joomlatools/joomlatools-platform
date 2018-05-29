<?php
defined('JPATH_BASE') or die;

$items = isset($displayData['items']) ? $displayData['items'] : false;
$text = isset($displayData['text']) ? $displayData['text'] : false;
$type = isset($displayData['type']) ? $displayData['type'] : false;
$plural = isset($displayData['plural']) ? $displayData['plural'] : $type . 's';
$button = isset($displayData['button']) ? $displayData['button'] : '.k-toolbar .k-button:first-child';
$displayButton = isset($displayData['displayButton']) ? $displayData['displayButton'] : true;
?>

<?php if (!$items): ?>
    <div class="k-empty-state">
        <?php if ($text): ?>
        <p><?php echo $text; ?></p>
        <?php else: ?>
        <p>It seems like you don't have any <?php echo $plural; ?> yet.</p>
        <?php endif; ?>
        <?php if ($displayButton): ?>
        <p>
            <button id="onboardaction" class="k-button k-button--success k-button--large">
                Add your first <?php echo $type; ?>
            </button>
        </p>
        <script>
            kQuery(function($) {
                $('#onboardaction').on('click', function() {
                    $('<?php echo $button; ?>').trigger('click');
                })
            });
        </script>
        <?php endif; ?>
    </div>
<?php endif; ?>
