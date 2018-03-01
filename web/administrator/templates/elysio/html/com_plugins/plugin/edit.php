<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_plugins
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.formvalidator');
$this->fieldsets = $this->form->getFieldsets('params');

JFactory::getDocument()->addScriptDeclaration("
	Joomla.submitbutton = function(task)
	{
		if (task == 'plugin.cancel' || document.formvalidator.isValid(document.getElementById('style-form'))) {
			Joomla.submitform(task, document.getElementById('style-form'));
		}
	};
");

// Overrides
include_once(JPATH_WEB.'/administrator/templates/elysio/html/overrides.php');
?>

<!-- Component -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_plugins&layout=edit&extension_id=' . (int) $this->item->extension_id); ?>" method="post" name="adminForm" id="style-form">

    <!-- Tabs container -->
    <div class="k-tabs-container">

        <?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>

        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_PLUGINS_PLUGIN', true)); ?>
            <div class="k-container">
                <div class="k-container__main">
                    <?php if ($this->item->xml) : ?>
                        <?php if ($this->item->xml->description) : ?>
                        <div class="k-well">
                            <h3 class="k-heading no-margin-bottom">
                                <?php
                                if ($this->item->xml)
                                {
                                    echo ($text = (string) $this->item->xml->name) ? JText::_($text) : $this->item->name;
                                }
                                else
                                {
                                    echo JText::_('COM_PLUGINS_XML_ERR');
                                }
                                ?>
                            </h3>
                            <p>
                                <span class="label hasTooltip" title="<?php echo JHtml::tooltipText('COM_PLUGINS_FIELD_FOLDER_LABEL', 'COM_PLUGINS_FIELD_FOLDER_DESC'); ?>">
                                    <?php echo $this->form->getValue('folder'); ?>
                                </span> /
                                <span class="label hasTooltip" title="<?php echo JHtml::tooltipText('COM_PLUGINS_FIELD_ELEMENT_LABEL', 'COM_PLUGINS_FIELD_ELEMENT_DESC'); ?>">
                                    <?php echo $this->form->getValue('element'); ?>
                                </span>
                            </p>
                            <div>
                                <?php
                                $short_description = JText::_($this->item->xml->description);
                                $this->fieldset = 'description';
                                $long_description = JLayoutHelper::render('joomla.edit.fieldset', $this);
                                if(!$long_description) {
                                    $truncated = JHtmlString::truncate($short_description, 550, true, false);
                                    if(strlen($truncated) > 500) {
                                        $long_description = $short_description;
                                        $short_description = JHtmlString::truncate($truncated, 250);
                                        if($short_description == $long_description) {
                                            $long_description = '';
                                        }
                                    }
                                }
                                ?>
                                <p><?php echo $short_description; ?></p>
                                <?php if ($long_description) : ?>
                                    <p class="readmore">
                                        <a href="#" onclick="jQuery('.nav-tabs a[href=#description]').tab('show');">
                                            <?php echo JText::_('JGLOBAL_SHOW_FULL_DESCRIPTION'); ?>
                                        </a>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <div class="k-alert k-alert--error"><?php echo JText::_('COM_PLUGINS_XML_ERR'); ?></div>
                    <?php endif; ?>
                    <?php
                    $this->fieldset = 'basic';
                    $html = JLayoutHelper::render('joomla.edit.fieldset', $this);
                    echo $html ? '<hr />' . $html : '';
                    ?>
                </div>
                <div class="k-container__sub">
                    <?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>

                    <fieldset class="k-form-block">
                        <div class="k-form-block__header">Plugin</div>
                        <div class="k-form-block__content">
                            <div class="k-form-group">
                                <?php echo $this->form->getLabel('ordering'); ?>
                                <?php echo addFormControlClass($this->form->getInput('ordering')); ?>
                            </div>
                            <div class="k-form-group">
                                <?php echo $this->form->getLabel('folder'); ?>
                                <?php echo addFormControlClass($this->form->getInput('folder')); ?>
                            </div>
                            <div class="k-form-group">
                                <?php echo $this->form->getLabel('element'); ?>
                                <?php echo addFormControlClass($this->form->getInput('element')); ?>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <?php echo JHtml::_('bootstrap.endTab'); ?>

            <?php if (isset($long_description) && $long_description != '') : ?>
                <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'description', JText::_('JGLOBAL_FIELDSET_DESCRIPTION', true)); ?>
            <div class="k-container">
                <div class="k-container__full">
                    <?php echo $long_description; ?>
                </div>
            </div>
                <?php echo JHtml::_('bootstrap.endTab'); ?>
            <?php endif; ?>

            <?php
            $this->fieldsets = array();
            $this->ignore_fieldsets = array('basic', 'description');
            echo JLayoutHelper::render('joomla.edit.params', $this);
            ?>

        <?php echo JHtml::_('bootstrap.endTabSet'); ?>

    </div><!-- .k-tabs-container -->

    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>

</form>
