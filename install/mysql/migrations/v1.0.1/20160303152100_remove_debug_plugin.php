<?php
use Phinx\Migration\AbstractMigration;

/**
 * Class RemoveDebugPlugin
 *
 * Remove the debug plugin
 * Issue: https://github.com/joomlatools/joomlatools-platform/issues/261
 */
class RemoveDebugPlugin extends AbstractMigration
{
    public function up()
    {
        $this->execute("DELETE FROM `extensions` WHERE `extensions`.`name` = 'plg_system_debug'");
    }

    public function down()
    {
        $sql = <<<EOL
INSERT INTO `extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
    (425, 'plg_system_debug', 'plugin', 'debug', 'system', 0, 1, 1, 0, '', '{"profile":"1","queries":"1","memory":"1","language_files":"1","language_strings":"1","strip-first":"1","strip-prefix":"","strip-suffix":""}', '', '', 0, '0000-00-00 00:00:00', 4, 0);
EOL;

        $this->execute($sql);
    }
}
