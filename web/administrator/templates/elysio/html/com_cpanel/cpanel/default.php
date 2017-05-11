<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_cpanel
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$user = JFactory::getUser();
?>

<div class="k-container">

    <div class="k-container__full">

        <!-- Content -->
        <?php
        $spans = 0;

        foreach ($this->modules as $module)
        {
            // Get module parameters
            $params = new JRegistry;
            $params->loadString($module->params);
            $bootstrapSize = $params->get('bootstrap_size');
            if (!$bootstrapSize)
            {
                $bootstrapSize = 12;
            }
            $spans += $bootstrapSize;
            if ($spans > 12)
            {
                $spans = $bootstrapSize;
            }
            echo JModuleHelper::renderModule($module, array('style' => 'basic'));
        }
        ?>

    </div>

</div>
