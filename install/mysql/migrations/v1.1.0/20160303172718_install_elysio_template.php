<?php
use Phinx\Migration\AbstractMigration;

/**
 * Class InstallElysioTemplate
 *
 * Add Elysio administrator template
 * Issue : https://github.com/joomlatools/joomlatools-platform/issues/260
 */
class InstallElysioTemplate extends AbstractMigration
{
    public function up()
    {
        $template = array(
            'id'        => 9,
            'template'  => 'elysio',
            'client_id' => 1,
            'home'      => 1,
            'title'     => 'elysio - Default',
            'params'    => '{}'
        );

        $table = $this->table('templates');
        $table->insert($template);
        $table->saveData();

        $extension = array(
            'extension_id' => 508,
            'name'         => 'elysio',
            'type'         => 'template',
            'element'      => 'elysio',
            'client_id'    => 1,
            'enabled'      => 1,
            'access'       => 1
        );

        $table = $this->table('extensions');
        $table->insert($extension);
        $table->saveData();
    }

    public function down()
    {
        $this->execute("DELETE FROM `extensions` WHERE `extension_id` = 508;");
        $this->execute("DELETE FROM `templates` WHERE `id` = 9;");
    }
}
