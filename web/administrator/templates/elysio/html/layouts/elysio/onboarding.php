<?php
defined('JPATH_BASE') or die;

$items = $displayData['items'];
$type = $displayData['type'];
$plural = isset($displayData['plural']) ? $displayData['plural'] : $type . 's';
$button = isset($displayData['button']) ? $displayData['button'] : '.k-toolbar .k-button:first-child';
?>

<?php if (!$items): ?>
    <div class="k-empty-state">
        <p>It seems like you don't have any <?php echo $plural; ?> yet.</p>
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
    </div>
<?php endif; ?>
