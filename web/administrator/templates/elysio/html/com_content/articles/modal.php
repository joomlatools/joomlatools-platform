<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = JFactory::getApplication();

if ($app->isSite())
{
	JSession::checkToken('get') or die(JText::_('JINVALID_TOKEN'));
}

require_once JPATH_COMPONENT_SITE . '/helpers/route.php';

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.framework', true);

$function  = $app->input->getCmd('function', 'jSelectArticle');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<script src="templates/elysio/js/kui-initialize.js"></script>

<script>
    kQuery(function($) {
        $('.k-table a').on('click', function(event) {
            $(window.parent.document.querySelector('.mfp-close')).trigger('click');
        });
    });
</script>

<!-- Wrapper -->
<div class="k-wrapper k-js-wrapper">

    <!-- Content wrapper -->
    <div class="k-content-wrapper">

        <!-- Content -->
        <div class="k-content k-js-content">

            <!-- Component wrapper -->
            <div class="k-component-wrapper">

                <!-- Component -->
                <form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_content&view=articles&layout=modal&tmpl=component&function='.$function.'&'.JSession::getFormToken().'=1');?>" name="adminForm" id="adminForm" method="post">

                    <!-- Scopebar -->
                    <div class="k-scopebar k-js-scopebar" id="filter-bar">

                        <!-- Toggle buttons -->
                        <div class="k-scopebar__item k-scopebar__item--toggle-buttons">
                            <button type="button" class="k-scopebar__button k-toggle-scopebar-search k-js-toggle-search">
                                <span class="k-icon-magnifying-glass" aria-hidden="true">
                                    <span class="k-visually-hidden">Search toggle</span>
                                    <div class="k-js-search-count k-scopebar__item-label k-scopebar__item-label--numberless" style="display: none"></div>
                                </span>
                            </button>
                            <button type="button" class="k-scopebar__button k-toggle-scopebar-filters k-js-toggle-filters">
                                <span class="k-icon-filter" aria-hidden="true">
                                    <span class="k-visually-hidden">Filters toggle</span>
                                    <div class="k-js-filter-count k-scopebar__item-label k-scopebar__item-label--numberless"></div>
                                </span>
                            </button>
                        </div>

                        <!-- Filters holder -->
                        <div class="k-dynamic-content-holder">
                            <div class="k-js-filters">
                                <div data-filter data-title="Access">
                                    <select name="filter_access" class="input-medium" onchange="this.form.submit()">
                                        <option value=""><?php echo JText::_('JOPTION_SELECT_ACCESS');?></option>
                                        <?php echo JHtml::_('select.options', JHtml::_('access.assetgroups'), 'value', 'text', $this->state->get('filter.access'));?>
                                    </select>
                                </div>
                                <div data-filter data-title="Published">
                                    <select name="filter_published" class="input-medium" onchange="this.form.submit()">
                                        <option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
                                        <?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true);?>
                                    </select>
                                </div>
                                <?php if ($this->state->get('filter.forcedLanguage')) : ?>
                                    <div data-filter data-title="Language">
                                        <select name="filter_category_id" class="input-medium" onchange="this.form.submit()">
                                            <option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY');?></option>
                                            <?php echo JHtml::_('select.options', JHtml::_('category.options', 'com_content', array('filter.language' => array('*', $this->state->get('filter.forcedLanguage')))), 'value', 'text', $this->state->get('filter.category_id'));?>
                                        </select>
                                        <input type="hidden" name="forcedLanguage" value="<?php echo $this->escape($this->state->get('filter.forcedLanguage')); ?>" />
                                        <input type="hidden" name="filter_language" value="<?php echo $this->escape($this->state->get('filter.language')); ?>" />
                                    </div>
                                <?php else : ?>
                                    <div data-filter data-title="Category id">
                                        <select name="filter_category_id" class="input-medium" onchange="this.form.submit()">
                                            <option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY');?></option>
                                            <?php echo JHtml::_('select.options', JHtml::_('category.options', 'com_content'), 'value', 'text', $this->state->get('filter.category_id'));?>
                                        </select>
                                    </div>
                                    <div data-filter data-title="Language">
                                        <select name="filter_language" class="input-medium" onchange="this.form.submit()">
                                            <option value=""><?php echo JText::_('JOPTION_SELECT_LANGUAGE');?></option>
                                            <?php echo JHtml::_('select.options', JHtml::_('contentlanguage.existing', true, true), 'value', 'text', $this->state->get('filter.language'));?>
                                        </select>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Filters -->
                        <div class="k-scopebar__item--filters">
                            <div class="k-scopebar__filters-content">
                                <div class="k-scopebar__filters k-js-filter-container">
                                    <div style="display: none;" class="k-scopebar__item--filter k-scopebar-dropdown k-js-filter-prototype k-js-dropdown">
                                        <button type="button" class="k-scopebar-dropdown__button k-js-dropdown-button">
                                            <span class="k-scopebar__item--filter__title k-js-dropdown-title"></span>
                                            <span class="k-scopebar__item--filter__icon k-icon-chevron-bottom" aria-hidden="true"></span>
                                            <div class="k-scopebar__item__label k-js-dropdown-label"></div>
                                        </button>
                                        <div class="k-scopebar-dropdown__body k-js-dropdown-body">
                                            <div class="k-scopebar-dropdown__body__buttons">
                                                <button type="button" class="k-button k-button--default k-js-clear-filter">Clear</button>
                                                <button type="button" class="k-button k-button--primary k-js-apply-filter">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Search -->
                        <div class="k-scopebar__item k-scopebar__item--search">
                            <div class="k-search k-search--has-both-buttons">
                                <label for="k-search-input">Search</label>
                                <input type="search" class="k-search__field" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>" placeholder="Find by title or description&hellip;" />
                                <button type="submit" class="k-search__submit">
                                    <span class="k-icon-magnifying-glass" aria-hidden="true"></span>
                                    <span class="k-visually-hidden">Search</span>
                                </button>
                                <button type="button" class="k-search__empty">
                                    <span class="k-search__empty-area">
                                        <span class="k-icon-x" aria-hidden="true"></span>
                                        <span class="k-visually-hidden">Clear search</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div><!-- .k-scopebar -->

                    <!-- Table -->
                    <div class="k-table-container">
                        <div class="k-table">
                            <table class="k-js-responsive-table">
                                <thead>
                                    <tr>
                                        <th class="k-table-data--toggle" data-toggle="true">
                                            <?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
                                        </th>
                                        <th width="1%" class="k-table-data--toggle" data-toggle="true"></th>
                                        <th width="1%">
                                            <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ACCESS', 'access_level', $listDirn, $listOrder); ?>
                                        </th>
                                        <th width="1%" data-hide="phone,tablet">
                                            <?php echo JHtml::_('grid.sort', 'JCATEGORY', 'a.catid', $listDirn, $listOrder); ?>
                                        </th>
                                        <th width="1%" data-hide="phone,tablet">
                                            <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_LANGUAGE', 'language', $listDirn, $listOrder); ?>
                                        </th>
                                        <th width="1%" data-hide="phone,tablet">
                                            <?php echo JHtml::_('grid.sort', 'JDATE', 'a.created', $listDirn, $listOrder); ?>
                                        </th>
                                        <th width="1%" data-hide="phone,tablet">
                                            <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($this->items as $i => $item) : ?>
                                    <?php if ($item->language && JLanguageMultilang::isEnabled())
                                    {
                                        $tag = strlen($item->language);
                                        if ($tag == 5)
                                        {
                                            $lang = substr($item->language, 0, 2);
                                        }
                                        elseif ($tag == 6)
                                        {
                                            $lang = substr($item->language, 0, 3);
                                        }
                                        else {
                                            $lang = "";
                                        }
                                    }
                                    elseif (!JLanguageMultilang::isEnabled())
                                    {
                                        $lang = "";
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->title)); ?>', '<?php echo $this->escape($item->catid); ?>', null, '<?php echo $this->escape(ContentHelperRoute::getArticleRoute($item->id, $item->catid, $item->language)); ?>', '<?php echo $this->escape($lang); ?>', null);">
                                                <?php echo $this->escape($item->title); ?></a>
                                        </td>
                                        <td class="k-table-data--toggle"></td>
                                        <td>
                                            <?php echo $this->escape($item->access_level); ?>
                                        </td>
                                        <td>
                                            <?php echo $this->escape($item->category_title); ?>
                                        </td>
                                        <td>
                                            <?php if ($item->language == '*'):?>
                                                <?php echo JText::alt('JALL', 'language'); ?>
                                            <?php else:?>
                                                <?php echo $item->language_title ? $this->escape($item->language_title) : JText::_('JUNDEFINED'); ?>
                                            <?php endif;?>
                                        </td>
                                        <td class="k-table-data--nowrap">
                                            <?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC4')); ?>
                                        </td>
                                        <td>
                                            <?php echo (int) $item->id; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div><!-- .k-table -->

                        <!-- Pagination -->
                        <?php echo JLayoutHelper::render('elysio.pagination', array('view' => $this, 'pages' => $this->pagination->getListFooter())); ?>

                        <input type="hidden" name="task" value="" />
                        <input type="hidden" name="boxchecked" value="0" />
                        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
                        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
                        <?php echo JHtml::_('form.token'); ?>

                    </div><!-- .k-table-container -->

                </form><!-- .k-component -->

            </div><!-- .k-component-wrapper -->

        </div><!-- .k-content -->

    </div><!-- .k-content-wrapper -->

</div><!-- .k-wrapper -->
