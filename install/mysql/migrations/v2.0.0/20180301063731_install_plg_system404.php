<?php

use Phinx\Migration\AbstractMigration;

class InstallPlgSystem404 extends AbstractMigration
{
    public function up()
    {
        $sql = <<<EOL
INSERT INTO `extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`)
VALUES
    (450, 'plg_system_404', 'plugin', '404', 'system', 0, 1, 1, 0, '{}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0);
EOL;

        $this->execute($sql);
    }

    public function down()
    {
        $this->execute("DELETE FROM `extensions` WHERE `extensions`.`name` = 'plg_system_404'");
    }
}
