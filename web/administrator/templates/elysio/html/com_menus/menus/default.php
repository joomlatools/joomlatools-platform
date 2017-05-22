<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_menus
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('behavior.modal');

$uri = JUri::getInstance();
$return = base64_encode($uri);
$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
$modMenuId = (int) $this->get('ModMenuId');

$canCreate = $user->authorise('core.create',     'com_menus');
$canEdit   = $user->authorise('core.edit',       'com_menus');
$canChange = $user->authorise('core.edit.state', 'com_menus');

JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'submenu');
?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task != 'menus.delete' || confirm('<?php echo JText::_('COM_MENUS_MENU_CONFIRM_DELETE', true);?>'))
		{
			Joomla.submitform(task);
		}
	}
</script>

<!-- Form -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_menus&view=menus');?>" method="get" name="adminForm" id="adminForm">

    <!-- Scopebar -->
    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this, 'options' => array('filterButton' => false))); ?>

    <!-- Table -->
    <?php echo $this->loadTemplate('table'); ?>

</form><!-- .k-component -->
