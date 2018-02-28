<?php
/**
 * @package     Joomla.Cms
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$form = $displayData->getForm();

$title = $form->getField('title') ? 'title' : ($form->getField('name') ? 'name' : '');

// Overrides
include_once(JPATH_WEB.'/administrator/templates/elysio/html/overrides.php');
?>

<div class="k-input-group k-input-group--large">
    <?php echo addInputGroupAddonClass($title ? $form->getLabel($title) : ''); ?>
    <?php echo addFormControlClass($title ? $form->getInput($title) : ''); ?>
</div>
