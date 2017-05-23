<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$template = $app->getTemplate();

// Load the tooltip behavior.
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.formvalidation');
?>
<script type="text/javascript">
    Joomla.submitbutton = function(task)
    {
        if (document.formvalidator.isValid(document.id('component-form')))
        {
            Joomla.submitform(task, document.getElementById('component-form'));
        }
    }
</script>

<?php JFactory::getDocument()->setBuffer($this->loadTemplate('navigation'), 'modules', 'sidebar'); ?>

<div class="k-container">
    <form class="k-container__full" action="<?php echo JRoute::_('index.php?option=com_config'); ?>" id="component-form" method="post" name="adminForm" autocomplete="off">
        <?php $fieldSets = $this->form->getFieldsets(); ?>
        <ul class="nav nav-tabs<?php echo count($fieldSets) == 1 ? ' k-hidden' : '';?>" id="configTabs">
            <?php foreach ($fieldSets as $name => $fieldSet) : ?>
                <?php $label = empty($fieldSet->label) ? 'COM_CONFIG_' . $name . '_FIELDSET_LABEL' : $fieldSet->label; ?>
                <li><a href="#<?php echo $name; ?>" data-toggle="tab"><?php echo JText::_($label); ?></a></li>
            <?php endforeach; ?>
        </ul>
        <?php echo count($fieldSets) > 1 ? '<div class="tab-content">' : '';?>
            <?php foreach ($fieldSets as $name => $fieldSet) : ?>
                <?php echo count($fieldSets) > 1 ? '<div class="tab-pane" id="'.$name.'">' : '';?>
                    <div class="k-heading"><?php echo JText::_($fieldSet->label); ?></div>
                    <?php
                    if (isset($fieldSet->description) && !empty($fieldSet->description))
                    {
                        echo '<p class="k-alert k-alert--info">' . JText::_($fieldSet->description) . '</p>';
                    }
                    ?>
                    <?php foreach ($this->form->getFieldset($name) as $field) : ?>
                        <?php
                        $class = '';
                        $rel = '';
                        if ($showon = $field->getAttribute('showon'))
                        {
                            JHtml::_('jquery.framework');
                            JHtml::_('script', 'jui/cms.js', false, true);
                            $id = $this->form->getFormControl();
                            $showon = explode(':', $showon, 2);
                            $class = ' showon_' . implode(' showon_', explode(',', $showon[1]));
                            $rel = ' rel="showon_' . $id . '[' . $showon[0] . ']"';
                        }
                        ?>
                        <div class="control-group<?php echo $class; ?>"<?php echo $rel; ?>>
                            <?php if (!$field->hidden && $name != "permissions") : ?>
                                <div class="control-label">
                                    <?php echo $field->label; ?>
                                </div>
                            <?php endif; ?>
                            <div<?php $name != "permissions" ? ' class="controls' : '' ?>>
                                <?php echo $field->input; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php echo count($fieldSets) > 1 ? '</div>' : '';?>
            <?php endforeach; ?>
        <?php echo count($fieldSets) > 1 ? '</div>' : '';?>
        <input type="hidden" name="id" value="<?php echo $this->component->id; ?>" />
        <input type="hidden" name="component" value="<?php echo $this->component->option; ?>" />
        <input type="hidden" name="return" value="<?php echo $this->return; ?>" />
        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>
    </form>

</div>

<script type="text/javascript">
    jQuery('#configTabs a:first').tab('show'); // Select first tab
</script>
