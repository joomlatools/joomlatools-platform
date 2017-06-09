<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_menus
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.core');
JHtml::_('behavior.tabstate');
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');

JText::script('ERROR');
JText::script('JGLOBAL_VALIDATION_FORM_FAILED');

$assoc = JLanguageAssociations::isEnabled();

// Ajax for parent items
$script = "
jQuery(document).ready(function ($){
	$('#jform_menutype').change(function(){
		var menutype = $(this).val();
		$.ajax({
			url: 'index.php?option=com_menus&task=item.getParentItem&menutype=' + menutype,
			dataType: 'json'
		}).done(function(data) {
			$('#jform_parent_id option').each(function() {
				if ($(this).val() != '1') {
					$(this).remove();
				}
			});

			$.each(data, function (i, val) {
				var option = $('<option>');
				option.text(val.title).val(val.id);
				$('#jform_parent_id').append(option);
			});
			$('#jform_parent_id').trigger('liszt:updated');
		});
	});
});
Joomla.submitbutton = function(task, type){
	if (task == 'item.setType' || task == 'item.setMenuType')
	{
		if (task == 'item.setType')
		{
			jQuery('#item-form input[name=\"jform[type]\"]').val(type);
			jQuery('#fieldtype').val('type');
		} else {
			jQuery('#item-form input[name=\"jform[menutype]\"]').val(type);
		}
		Joomla.submitform('item.setType', document.getElementById('item-form'));
	} else if (task == 'item.cancel' || document.formvalidator.isValid(document.getElementById('item-form')))
	{
		Joomla.submitform(task, document.getElementById('item-form'));
	}
	else
	{
		// special case for modal popups validation response
		jQuery('#item-form .modal-value.invalid').each(function(){
			var field = jQuery(this),
				idReversed = field.attr('id').split('').reverse().join(''),
				separatorLocation = idReversed.indexOf('_'),
				nameId = '#' + idReversed.substr(separatorLocation).split('').reverse().join('') + 'name';
			jQuery(nameId).addClass('invalid');
		});
	}
};
";

$input = JFactory::getApplication()->input;

// Add the script to the document head.
JFactory::getDocument()->addScriptDeclaration($script);
$tmpl = $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
?>

<!-- Overrides -->
<script>
    kQuery(function($) {
        // Menu item type layout
        $('#jform_type').addClass('k-form-control').parent().addClass('k-input-group').removeClass('input-append').children('.btn').addClass('k-button k-button--primary').removeClass('btn btn-primary').wrap('<span class="k-input-group__button">');

        // menu item type modal
        $('#menuTypeModal').detach().appendTo('body');
    });
</script>

<!-- Form -->
<form class="k-component k-js-component k-js-form-controller form-validate" action="<?php echo JRoute::_('index.php?option=com_menus&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="item-form">

	<!-- Container -->
	<div class="k-container">
        <div class="k-container__main">
            <?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
        </div>
    </div>

    <div class="k-tabs-container">

		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', JText::_('COM_MENUS_ITEM_DETAILS')); ?>

            <div class="k-container">

                <!-- Main information -->
                <div class="k-container__main">

                    <?php
                    echo $this->form->renderField('type');

                    echo $this->form->renderField('menutype');

                    if ($this->item->type == 'alias')
                    {
                        echo $this->form->renderFieldset('aliasoptions');
                    }

                    echo $this->form->renderFieldset('request');

                    if ($this->item->type == 'url')
                    {
                        $this->form->setFieldAttribute('link', 'readonly', 'false');
                    }

                    echo $this->form->renderField('link');

                    echo $this->form->renderField('alias');

                    echo $this->form->renderField('browserNav');

                    echo $this->form->renderField('template_style_id');

                    ?>

                </div><!-- .k-container__main -->

                <!-- Sub information -->
                <div class="k-container__sub">

                    <fieldset class="k-form-block">
                        <div class="k-form-block__header">Global</div>
                        <div class="k-form-block__content">
                            <?php
                            // Set main fields.
                            $this->fields = array(
                                'parent_id',
                                'menuordering',
                            );
                            if ($this->item->type != 'component')
                            {
                                $this->fields = array_diff($this->fields, array('home'));
                            }
                            ?>
                            <?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
                        </div>
                    </fieldset>

                    <fieldset class="k-form-block">
                        <div class="k-form-block__header">Publishing / access</div>
                        <div class="k-form-block__content">
                            <?php
                            // Set main fields.
                            $this->fields = array(
                                'published',
                                'home',
                                'access',
                                'language',
                            );
                            if ($this->item->type != 'component')
                            {
                                $this->fields = array_diff($this->fields, array('home'));
                            }
                            ?>
                            <?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
                        </div>
                    </fieldset>

                    <fieldset class="k-form-block">
                        <div class="k-form-block__header">Extra</div>
                        <div class="k-form-block__content">
                            <?php
                            // Set main fields.
                            $this->fields = array(
                                'note'
                            );
                            if ($this->item->type != 'component')
                            {
                                $this->fields = array_diff($this->fields, array('home'));
                            }
                            ?>
                            <?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
                        </div>
                    </fieldset>

                </div><!-- .k-container__sub -->

            </div>

		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php
		$this->fieldsets = array();
		$this->ignore_fieldsets = array('aliasoptions', 'request');
		echo JLayoutHelper::render('joomla.edit.params', $this);
		?>

		<?php if ($assoc) : ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'associations', JText::_('JGLOBAL_FIELDSET_ASSOCIATIONS')); ?>
                <div class="k-container">
                    <!-- Main information -->
                    <div class="k-container__main">
                        <?php echo $this->loadTemplate('associations'); ?>
                    </div>
                </div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php endif; ?>

		<?php if (!empty($this->modules)) : ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'modules', JText::_('COM_MENUS_ITEM_MODULE_ASSIGNMENT')); ?>
                <?php echo $this->loadTemplate('modules'); ?>
            <?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php endif; ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
	</div>

	<input type="hidden" name="task" value="" />
	<?php echo $this->form->getInput('component_id'); ?>
	<?php echo JHtml::_('form.token'); ?>
	<input type="hidden" id="fieldtype" name="fieldtype" value="" />
</form>

