<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

JHtml::_('behavior.core');

$doTask   = $displayData['doTask'];
$class    = $displayData['class'];
$text     = $displayData['text'];
$btnClass = $displayData['btnClass'];

// Override Joomla framework classes
if (strpos($btnClass, 'btn-success') !== false) {
    $btnClass = ' k-button--success';
} else {
    $btnClass = ' k-button--default';
}

include_once(JPATH_WEB.'/administrator/templates/elysio/html/overrides.php');
$class = classOverride($class);
?>

<button onclick="<?php echo $doTask; ?>" class="k-button--<?php echo JFilterOutput::stringURLSafe($text); ?> k-button<?php echo $btnClass; ?>">
	<span class="<?php echo trim($class); ?>"></span>
	<?php echo $text; ?>
</button>
