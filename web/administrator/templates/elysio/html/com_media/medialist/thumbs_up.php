<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<?php if ($this->state->folder != '') : ?>

    <div class="k-gallery__item k-gallery__item--file">
        <div class="k-card">
            <a href="index.php?option=com_media&amp;view=mediaList&amp;tmpl=component&amp;folder=<?php echo $this->state->parent; ?>" class="k-card__body">
                <div class="k-ratio-block k-ratio-block--4-to-3">
                    <div class="k-ratio-block__body k-flexbox-column">
                        <span class="k-icon-chevron-left k-icon--size-large"></span>
                    </div>
                </div>
            </a>
            <div class="k-card__caption">
                <div class="k-flag-object">
                    <div class="k-flag-object__body">
                        ..
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
