<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
include_once(JPATH_WEB.'/administrator/templates/elysio/html/overrides.php');

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
<?php if(isset($displayData['name']) && $displayData['name'] == 'title') : ?>
    <div class="k-form-group k-form-group--large">
        <label><?php echo $displayData['label']; ?></label>
        <?php echo setFormInputAttributes($displayData['input'], array('class' => 'k-form-control', 'placeholder' => 'Title')); ?>
    </div>
<?php else : ?>
	<div class="k-form-group">
		<?php if (empty($displayData['options']['hiddenLabel'])) : ?>
			<label><?php echo $displayData['label']; ?></label>
		<?php endif; ?>
        <?php echo addFormControlClass($displayData['input']); ?>
	</div>
<?php endif; ?>
