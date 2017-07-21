<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$selector = empty($displayData['selector']) ? '' : $displayData['selector'];

?>

<div class="k-tabs-wrapper k-js-tabs-wrapper">
    <div class="k-tabs-scroller k-js-tabs-scroller">
        <ul class="nav nav-tabs k-tabs k-js-tabs" id="<?php echo $selector; ?>Tabs"></ul>
    </div>
</div>
<div class="tab-content k-tabs-content" id="<?php echo $selector; ?>Content">