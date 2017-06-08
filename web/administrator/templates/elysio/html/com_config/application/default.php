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

// Load JS message titles
JText::script('ERROR');
JText::script('WARNING');
JText::script('NOTICE');
JText::script('MESSAGE');

JFactory::getDocument()->addScriptDeclaration('
	Joomla.submitbutton = function(task)
	{
		if (task === "config.cancel.application" || document.formvalidator.isValid(document.getElementById("application-form")))
		{
			jQuery("#permissions-sliders select").attr("disabled", "disabled");
			Joomla.submitform(task, document.getElementById("application-form"));
		}
	};
');
?>

<?php JFactory::getDocument()->setBuffer($this->loadTemplate('navigation'), 'modules', 'sidebar'); ?>

<div class="k-container">

	<form class="k-container__full" action="<?php echo JRoute::_('index.php?option=com_config'); ?>" id="application-form" method="post" name="adminForm">

        <?php echo $this->loadTemplate('permissions'); ?>

        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>

	</form>

</div>
