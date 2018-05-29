<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php if (isset($this->folders['children'])) : ?>
    <?php foreach ($this->folders['children'] as $folder) : ?>

        <?php $target = str_replace('/', '-', $folder['data']->relative); ?>

        <?php $GLOBALS['mediaTreeId']++; ?>

        {
            "label": "<?php echo $folder['data']->name; ?>",
            "id": <?php echo $GLOBALS['mediaTreeId']; ?>,
            "url": "index.php?option=com_media&view=mediaList&tmpl=component&folder=<?php echo $folder['data']->relative; ?>",
            <?php if($GLOBALS['mediaTreeParentId']): ?>"parent": <?php echo $GLOBALS['mediaTreeParentId']; ?><?php endif; ?>
        },

        <?php $GLOBALS['mediaTreeParentId'] = count($folder['children']) > 0 ? $GLOBALS['mediaTreeId'] : false ; ?>

        <?php echo $this->getFolderLevel($folder); ?>

    <?php endforeach; ?>
<?php endif; ?>
