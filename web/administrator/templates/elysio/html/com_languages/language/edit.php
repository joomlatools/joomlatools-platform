<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_languages
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.formvalidator');

JFactory::getDocument()->addScriptDeclaration(
    '
	Joomla.submitbutton = function(task)
	{
		if (task == "language.cancel" || document.formvalidator.isValid(document.getElementById("language-form")))
		{
			Joomla.submitform(task, document.getElementById("language-form"));
		}
	};

	jQuery(document).ready(function() {
		jQuery("#jform_image").on("change", function() {
			var flag = this.value;
			if (!jQuery("#flag img").attr("src")) {
				jQuery("#flag img").attr("src", "' . JUri::root(true) . '" + "/media/mod_languages/images/" + flag + ".gif");
			} else {
				jQuery("#flag img").attr("src", function(index, attr) {
					return attr.replace(jQuery("#flag img").attr("title") + ".gif", flag + ".gif")
				})
			}
			jQuery("#flag img").attr("title", flag).attr("alt", flag);
	});
});'
);
?>

<!-- Form -->
<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_languages&view=language&layout=edit&lang_id=' . (int) $this->item->lang_id); ?>" method="post" name="adminForm" id="language-form">

    <!-- Container -->
    <div class="k-container">
        <div class="k-container__main">
            <?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
        </div>
    </div>

    <div class="k-tabs-container">

	<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('JDETAILS')); ?>

        <div class="k-container">

            <!-- Main information -->
            <div class="k-container__main">

			<?php echo $this->form->renderField('title_native'); ?>
			<?php echo $this->form->renderField('lang_code'); ?>
			<?php echo $this->form->renderField('sef'); ?>
			<div class="k-form-group">
                <?php echo $this->form->getLabel('image'); ?>
                <?php echo $this->form->getInput('image'); ?>
                <p class="k-form-info">
                    <span id="flag">
                        <?php echo JHtml::_('image', 'mod_languages/' . $this->form->getValue('image') . '.gif', $this->form->getValue('image'), array('title' => $this->form->getValue('image')), true); ?>
                    </span>
                </p>
			</div>

            </div><!-- .k-container__main -->

            <!-- Sub information -->
            <div class="k-container__sub">
                <?php if ($this->canDo->get('core.edit.state')) : ?>
                    <?php echo $this->form->renderField('published'); ?>
                <?php endif; ?>
                <?php echo $this->form->renderField('access'); ?>
                <?php echo $this->form->renderField('description'); ?>
                <?php echo $this->form->renderField('lang_id'); ?>
            </div>

        </div>

		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'metadata', JText::_('JGLOBAL_FIELDSET_METADATA_OPTIONS')); ?>
        <div class="k-container">
            <!-- Main information -->
            <div class="k-container__main">
		        <?php echo $this->form->renderFieldset('metadata'); ?>
            </div>
        </div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'site_name', JText::_('COM_LANGUAGES_FIELDSET_SITE_NAME_LABEL')); ?>
        <div class="k-container">
            <!-- Main information -->
            <div class="k-container__main">
		        <?php echo $this->form->renderFieldset('site_name'); ?>
            </div>
        </div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.endTabSet'); ?>

    </div>

	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
