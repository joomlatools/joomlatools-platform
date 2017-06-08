<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_modules
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.popover');
$document = JFactory::getDocument();
?>



<div class="k-component">

    <div class="k-table-container">
        <div class="k-table">
            <table>
                <thead>
                <tr>
                    <th width="25%">
                        <?php echo JText::_('COM_MODULES_TYPE_CHOOSE')?>
                    </th>
                    <th width="75%">
                        <?php echo JText::_('TPL_ELYSIO_DESCRIPTION')?>
                    </th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->items as &$item) : ?>
                        <?php // Prepare variables for the link. ?>
                        <?php $link       = 'index.php?option=com_modules&task=module.add&eid=' . $item->extension_id; ?>
                        <?php $name       = $this->escape($item->name); ?>
                        <?php $desc       = $this->escape(strip_tags($item->desc)); ?>

                        <tr>
                            <td>
                                <a href="<?php echo JRoute::_($link);?>">
                                    <?php echo $name; ?>
                                </a>
                            </td>
                            <td class="k-table-data--ellipsis">
                                <small title="<?php echo $name; ?>"><?php echo $desc; ?></small>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div><!-- .k-component -->
