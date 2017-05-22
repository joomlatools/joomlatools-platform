<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_menus
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php if (!$this->items): ?>
    <div class="k-empty-state">
        <p>It seems like you don't have any menu items yet.</p>
        <p>
            <button id="onboardaction" class="k-button k-button--success k-button--large">
                Add your first menu item
            </button>
        </p>
        <script>
            kQuery(function($) {
                $('#onboardaction').on('click', function() {
                    $('.k-button--new').trigger('click');
                })
            });
        </script>
    </div>
<?php endif; ?>