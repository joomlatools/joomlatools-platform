<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @copyright   Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Load tooltips behavior
JHtml::_('behavior.formvalidation');
JHtml::_('bootstrap.tooltip');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'application.cancel' || document.formvalidator.isValid(document.id('application-form')))
		{
			Joomla.submitform(task, document.getElementById('application-form'));
		}
	}
</script>

<?php JFactory::getDocument()->setBuffer($this->loadTemplate('navigation'), 'modules', 'sidebar'); ?>

<div class="k-container">

	<form action="<?php echo JRoute::_('index.php?option=com_config'); ?>" id="application-form" method="post" name="adminForm">

		<ul class="nav nav-tabs">
			<li class="active"><a href="#page-permissions" data-toggle="tab"><?php echo JText::_('COM_CONFIG_PERMISSIONS'); ?></a></li>
		</ul>

		<div id="config-document" class="tab-content">
			<div id="page-permissions" class="tab-pane active">
				<div class="row-fluid">
					<?php echo $this->loadTemplate('permissions'); ?>
				</div>
			</div>
			<input type="hidden" name="task" value="" />
			<?php echo JHtml::_('form.token'); ?>
		</div>

	</form>

</div>
