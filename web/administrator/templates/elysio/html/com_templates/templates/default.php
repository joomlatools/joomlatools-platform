<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_templates
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

$user      = JFactory::getUser();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<?php JFactory::getDocument()->setBuffer($this->sidebar, 'modules', 'sidebar'); ?>

<form class="k-component k-js-component k-js-grid-controller k-js-grid" action="<?php echo JRoute::_('index.php?option=com_templates&view=templates'); ?>" method="post" name="adminForm" id="adminForm">

    <?php // Scopebar ?>
    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

    <?php if (empty($this->items)) : ?>
        <!-- Onboarding -->
        <?php echo JLayoutHelper::render('elysio.onboarding', array('items' => $this->items, 'type' => 'template')); ?>
    <?php else : ?>
    <!-- Table -->
    <div class="k-table-container<?php echo (!$this->items) ? ' k-hidden' : '' ?>">
        <div class="k-table">
            <table class="k-js-fixed-table-header k-js-responsive-table" id="itemList">
                <thead>
                <tr>
                    <th class="col1template hidden-phone" width="20%">
                        <?php echo JText::_('COM_TEMPLATES_HEADING_IMAGE'); ?>
                    </th>
                    <th width="30%">
                        <?php echo JHtml::_('searchtools.sort', 'COM_TEMPLATES_HEADING_TEMPLATE', 'a.element', $listDirn, $listOrder); ?>
                    </th>
                    <th width="10%" class="hidden-phone">
                        <?php echo JText::_('JVERSION'); ?>
                    </th>
                    <th width="15%" class="hidden-phone">
                        <?php echo JText::_('JDATE'); ?>
                    </th>
                    <th width="25%" class="hidden-phone" >
                        <?php echo JText::_('JAUTHOR'); ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->items as $i => $item) : ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <td class="center hidden-phone">
                            <?php echo JHtml::_('templates.thumb', $item->element, $item->client_id); ?>
                        </td>
                        <td class="template-name">
                            <strong><?php echo JText::sprintf('COM_TEMPLATES_TEMPLATE_DETAILS', ucfirst($item->name)); ?></strong>
                            <div>
                                <?php if ($this->preview && $item->client_id == '0') : ?>
                                    <a href="<?php echo JRoute::_(JUri::root() . 'index.php?tp=1&template=' . $item->element); ?>" target="_blank">
                                        <?php echo JText::_('COM_TEMPLATES_TEMPLATE_PREVIEW'); ?>
                                    </a>
                                <?php elseif ($item->client_id == '1') : ?>
                                    <?php echo JText::_('COM_TEMPLATES_TEMPLATE_NO_PREVIEW_ADMIN'); ?>
                                <?php else : ?>
                                    <span class="hasTooltip" title="<?php echo JHtml::tooltipText('COM_TEMPLATES_TEMPLATE_NO_PREVIEW_DESC'); ?>"><?php echo JText::_('COM_TEMPLATES_TEMPLATE_NO_PREVIEW'); ?></span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="small hidden-phone">
                            <?php echo $this->escape($item->xmldata->get('version')); ?>
                        </td>
                        <td class="small hidden-phone">
                            <?php echo $this->escape($item->xmldata->get('creationDate')); ?>
                        </td>
                        <td class="hidden-phone">
                            <?php if ($author = $item->xmldata->get('author')) : ?>
                                <div><?php echo $this->escape($author); ?></div>
                            <?php else : ?>
                                &mdash;
                            <?php endif; ?>
                            <?php if ($email = $item->xmldata->get('authorEmail')) : ?>
                                <div><?php echo $this->escape($email); ?></div>
                            <?php endif; ?>
                            <?php if ($url = $item->xmldata->get('authorUrl')) : ?>
                                <div><a href="<?php echo $this->escape($url); ?>"><?php echo $this->escape($url); ?></a></div>
                            <?php endif; ?>
                        </td>
                        <?php echo JHtml::_('templates.thumbModal', $item->element, $item->client_id); ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- .k-table -->

        <!-- Pagination -->
        <?php echo JLayoutHelper::render('elysio.pagination', array('view' => $this, 'pages' => $this->pagination->getListFooter())); ?>

        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <?php echo JHtml::_('form.token'); ?>

    </div><!-- .k-table-container -->

    <?php endif;?>

</form><!-- .k-component -->
