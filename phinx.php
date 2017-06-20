<?php
/**
 * @package    Joomlatools Platform
 *
 * @copyright  Copyright (C) 2016 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

define('_JEXEC', 1);
define('JPATH_ROOT'  , __DIR__);

require_once JPATH_ROOT . '/app/defines.php';
require_once JPATH_ROOT . '/app/bootstrap.php';

$config	= new JConfig;
$environment = getenv('JOOMLA_ENV');
$host = $config->host;
$port = 3306;

if (strstr($host, ':') !== false) {
    list($host, $port) = explode(':', $host);
}

return [
    'paths' => [
        'migrations' => [
            '%%PHINX_CONFIG_DIR%%/install/mysql/migrations/*/',
            '%%PHINX_CONFIG_DIR%%/app/administrator/components/com_*/resources/install/mysql/migrations/'
        ]
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database'        => $environment,
        $environment => [
            'adapter'   => 'mysql',
            'name'      => $config->db,
            'host'      => $host,
            'user'      => $config->user,
            'pass'      => $config->password,
            'port'      => $port,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci'
        ]
    ]
];