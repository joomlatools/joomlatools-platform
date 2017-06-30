<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<div class="k-sidebar-item">
    <?php if ($this->userIsSuperAdmin): ?>
        <div class="k-sidebar-item__header">
            <?php echo JText::_('COM_CONFIG_SYSTEM'); ?>
        </div>
        <ul class="k-list">
            <li>
                <a href="index.php?option=com_config"><?php echo JText::_('COM_CONFIG_GLOBAL_CONFIGURATION'); ?></a>
            </li>
        </ul>
    <?php endif; ?>
    <div class="k-sidebar-item__header">
        <?php echo JText::_('COM_CONFIG_COMPONENT_FIELDSET_LABEL'); ?>
    </div>
    <ul class="k-list">
        <?php foreach ($this->components as $component) : ?>
            <li<?php echo $this->currentComponent === $component ? ' class="active"' : '' ?>>
                <a href="index.php?option=com_config&view=component&component=<?php echo $component; ?>"><?php echo JText::_($component); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
