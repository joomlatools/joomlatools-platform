<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Template.Isis
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$msgList = $displayData['msgList'];

$alert = array('error' => 'k-alert--danger', 'warning' => 'k-alert--warning', 'notice' => 'k-alert--info', 'message' => 'k-alert--success');

?>

<?php if (is_array($msgList) && $msgList) : ?>
    <?php foreach ($msgList as $type => $msgs) : ?>
        <div class="k-alert <?php echo $alert[$type]; ?>">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php if ($msgs) : ?>
                <p>
                <?php foreach ($msgs as $msg) : ?>
                    <?php if ($msgs[0] == $msg) : ?>
                        <strong><?php echo JText::_($type); ?></strong>
                    <?php else: ?>
                        -<br/>
                    <?php endif; ?>
                    <?php echo $msg; ?><br />
                <?php endforeach; ?>
                </p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>