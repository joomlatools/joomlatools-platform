<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Layout variables
 * ---------------------
 * 	$options         : (array)  Optional parameters
 * 	$label           : (string) The html code for the label (not required if $options['hiddenLabel'] is true)
 * 	$input           : (string) The input field html code
 */

?>

<?php
if (!empty($displayData['options']['showonEnabled']))
{
	JHtml::_('jquery.framework');
	JHtml::_('script', 'jui/cms.js', false, true);
}
?>

<?php if($displayData['name'] == 'alias') : ?>
	<div class="form-group <?php echo $displayData['options']['class']; ?>" <?php echo $displayData['options']['rel']; ?>>
		<div class="input-group input-group-md input-group--alias">
			<div class="input-group-addon">
				<?php echo $displayData['label']; ?>
			</div>
			<?php echo $displayData['input']; ?>
		</div>
	</div>
<?php elseif($displayData['name'] == 'title') : ?>
	<div class="form-group <?php echo $displayData['options']['class']; ?>" <?php echo $displayData['options']['rel']; ?>>
		<?php echo $displayData['input']; ?>
	</div>
<?php else : ?>
	<div class="form-group <?php echo $displayData['options']['class']; ?>" <?php echo $displayData['options']['rel']; ?>>
		<?php if (empty($displayData['options']['hiddenLabel'])) : ?>
			<label><?php echo $displayData['label']; ?></label>
		<?php endif; ?>
		<?php echo $displayData['input']; ?>
	</div>
<?php endif; ?>


