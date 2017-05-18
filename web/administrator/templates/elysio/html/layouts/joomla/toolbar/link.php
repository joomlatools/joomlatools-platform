<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$doTask = $displayData['doTask'];
$class  = $displayData['class'];
$text   = $displayData['text'];

include_once(JPATH_WEB.'/administrator/templates/elysio/html/overrides.php');
$class = classOverride($class);

?>
<button onclick="location.href='<?php echo $doTask; ?>';" class="k-button--<?php echo JFilterOutput::stringURLSafe($text); ?> k-button k-button--default">
	<span class="<?php echo $class; ?>" aria-hidden="true"></span>
	<?php echo $text; ?>
</button>
