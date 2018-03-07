<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_modules
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Initialise related data.
JLoader::register('MenusHelper', JPATH_ADMINISTRATOR . '/components/com_menus/helpers/menus.php');
$menuTypes = MenusHelper::getMenuLinks();

JHtml::_('script', 'jui/treeselectmenu.jquery.min.js', false, true);

$script = "
	jQuery(document).ready(function()
	{
		menuHide(jQuery('#jform_assignment').val());
		jQuery('#jform_assignment').change(function()
		{
			menuHide(jQuery(this).val());
		})
	});
	function menuHide(val)
	{
		if (val == 0 || val == '-')
		{
			jQuery('#menuselect-group').hide();
		}
		else
		{
			jQuery('#menuselect-group').show();
		}
	}
";

// Add the script to the document head
JFactory::getDocument()->addScriptDeclaration($script);
?>

<!-- Container -->
<div class="k-container" style="overflow: visible">

    <div class="k-container__full">
        <div class="k-form-group">
            <label id="jform_menus-lbl" for="jform_menus"><?php echo JText::_('COM_MODULES_MODULE_ASSIGN'); ?></label>
            <div id="jform_menus">
                <select name="jform[assignment]" id="jform_assignment">
                    <?php echo JHtml::_('select.options', ModulesHelper::getAssignmentOptions($this->item->client_id), 'value', 'text', $this->item->assignment, true); ?>
                </select>
            </div>
        </div>
        <div id="menuselect-group" class="k-form-group">
            <label id="jform_menuselect-lbl" for="jform_menuselect"><?php echo JText::_('JGLOBAL_MENU_SELECTION'); ?></label>

            <div id="jform_menuselect">
                <?php if (!empty($menuTypes)) : ?>
                <?php $id = 'jform_menuselect'; ?>
                <div class="k-well">

                    <div class="k-form-row-group">
                        <div class="k-form-row">
                            <div class="k-form-row__item k-form-row__item--label">
                                <label for="input-form-row-1"><?php echo JText::_('JSELECT'); ?>:</label>
                            </div>
                            <div class="k-form-row__item k-form-row__item--input">
                                <div class="k-button-group">
                                    <a class="k-button k-button--default" id="treeCheckAll" href="javascript://">
                                        <?php echo JText::_('JALL'); ?>
                                    </a>
                                    <a class="k-button k-button--default" id="treeUncheckAll" href="javascript://">
                                        <?php echo JText::_('JNONE'); ?>
                                    </a>
                                </div>
                            </div>
                            <div class="k-form-row__item k-form-row__item--label">
                                <label for="input-form-row-1"><?php echo JText::_('COM_MODULES_EXPAND'); ?>:</label>
                            </div>
                            <div class="k-form-row__item k-form-row__item--input">
                                <div class="k-button-group">
                                    <a class="k-button k-button--default" id="treeExpandAll" href="javascript://">
                                        <?php echo JText::_('JALL'); ?>
                                    </a>
                                    <a class="k-button k-button--default" id="treeCollapseAll" href="javascript://">
                                        <?php echo JText::_('JNONE'); ?>
                                    </a>
                                </div>
                            </div>
                            <div class="k-form-row__item k-form-row__item--label">
                                <label for="input-form-row-2">Search:</label>
                            </div>
                            <div class="k-form-row__item k-form-row__item--input">
                                <input type="text" id="treeselectfilter" name="treeselectfilter" class="k-form-control search-query" size="16" autocomplete="off" placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>" aria-invalid="false" tabindex="-1">
                            </div>
                        </div>
                    </div>

                    <ul class="treeselect">
                        <?php foreach ($menuTypes as &$type) : ?>
                        <?php if (count($type->links)) : ?>
                            <?php $prevlevel = 0; ?>
                            <li>
                                <div class="treeselect-item">
                                    <label class="nav-header"><?php echo $type->title; ?></label>
                                </div>
                            <?php foreach ($type->links as $i => $link) : ?>
                                <?php
                                if ($prevlevel < $link->level)
                                {
                                    echo '<ul class="treeselect-sub">';
                                } elseif ($prevlevel > $link->level)
                                {
                                    echo str_repeat('</li></ul>', $prevlevel - $link->level);
                                } else {
                                    echo '</li>';
                                }
                                $selected = 0;
                                if ($this->item->assignment == 0)
                                {
                                    $selected = 1;
                                } elseif ($this->item->assignment < 0)
                                {
                                    $selected = in_array(-$link->value, $this->item->assigned);
                                } elseif ($this->item->assignment > 0)
                                {
                                    $selected = in_array($link->value, $this->item->assigned);
                                }
                                ?>
                                    <li>
                                        <div class="treeselect-item pull-left">
                                            <input type="checkbox" class="pull-left novalidate" name="jform[assigned][]" id="<?php echo $id . $link->value; ?>" value="<?php echo (int) $link->value; ?>"<?php echo $selected ? ' checked="checked"' : ''; ?> />
                                            <label for="<?php echo $id . $link->value; ?>" class="pull-left">
                                                <?php echo $link->text; ?> <span class="small"><?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($link->alias));?></span>
                                                <?php if (JLanguageMultilang::isEnabled() && $link->language != '' && $link->language != '*')
                                                {
                                                    echo JHtml::_('image', 'mod_languages/' . $link->language_image . '.gif', $link->language_title, array('title' => $link->language_title), true);
                                                }
                                                if ($link->published == 0)
                                                {
                                                    echo ' <span class="label">' . JText::_('JUNPUBLISHED') . '</span>';
                                                }
                                                ?>
                                            </label>
                                        </div>
                                <?php

                                if (!isset($type->links[$i + 1]))
                                {
                                    echo str_repeat('</li></ul>', $link->level);
                                }
                                $prevlevel = $link->level;
                                ?>
                                <?php endforeach; ?>
                            </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <div id="noresultsfound" style="display:none;" class="k-alert k-alert--info alert-no-items">
                        <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                    </div>
                    <div style="display:none;" id="treeselectmenu">
                        <div class="treeselect-menu">
                            <div class="k-button-group">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle k-button k-button--tiny k-button--default">
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="nav-header"><?php echo JText::_('COM_MODULES_SUBITEMS'); ?></li>
                                    <li class="divider"></li>
                                    <li class="">
                                        <a class="checkall" href="javascript://">
                                            <?php echo JText::_('JSELECT'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="uncheckall" href="javascript://">
                                            <?php echo JText::_('COM_MODULES_DESELECT'); ?>
                                        </a>
                                    </li>
                                    <div class="treeselect-menu-expand">
                                        <li class="divider"></li>
                                        <li>
                                            <a class="expandall k-button k-button--tiny" href="javascript://">
                                                <span class="icon-plus"></span>
                                                <?php echo JText::_('COM_MODULES_EXPAND'); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="collapseall k-button k-button--tiny" href="javascript://">
                                                <span class="icon-minus"></span>
                                                <?php echo JText::_('COM_MODULES_COLLAPSE'); ?>
                                            </a>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div><!-- .k-container -->
