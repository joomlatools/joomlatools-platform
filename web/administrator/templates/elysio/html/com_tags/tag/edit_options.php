<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php
	echo JHtml::_('bootstrap.startAccordion', 'categoryOptions', array('active' => 'collapse0'));
	$fieldSets = $this->form->getFieldsets('params');
	$i = 0;

	foreach ($fieldSets as $name => $fieldSet) :
		$label = !empty($fieldSet->label) ? $fieldSet->label : 'COM_TAGS_'.$name.'_FIELDSET_LABEL';
		echo JHtml::_('bootstrap.addSlide', 'categoryOptions', JText::_($label), 'collapse' . $i++);
			if (isset($fieldSet->description) && trim($fieldSet->description)) :
				echo '<p class="tip">'.$this->escape(JText::_($fieldSet->description)).'</p>';
			endif;
			?>
				<?php foreach ($this->form->getFieldset($name) as $field) : ?>
                    <div class="k-form-group">
                        <?php echo $field->label; ?>
                        <?php echo $field->input; ?>
					</div>
				<?php endforeach; ?>

				<?php if ($name == 'basic'):?>
                    <div class="k-form-group">
                        <?php echo $this->form->getLabel('note'); ?>
                        <?php echo $this->form->getInput('note'); ?>
					</div>
                    <div class="k-form-group">
                        <?php echo $this->form->getLabel('tag_layout'); ?>
                        <?php echo $this->form->getInput('tag_layout'); ?>
					</div>
                    <div class="k-form-group">
                        <?php echo $this->form->getLabel('tag_link_class'); ?>
                        <?php echo $this->form->getInput('tag_link_class'); ?>
					</div>
				<?php endif;
		echo JHtml::_('bootstrap.endSlide');
	endforeach;
echo JHtml::_('bootstrap.endAccordion');
