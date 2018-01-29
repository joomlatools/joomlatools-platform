<?php
/**
 * Joomlatools Platform - http://developer.joomlatools.org/platform
 *
 * @copyright	Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/joomlatools/joomlatools-platform for the canonical source repository
 */

class JConfig
{
    public function __construct()
    {
        /**
         * Load environment configuration
         */
        $env = new \Dotenv\Dotenv(dirname(__DIR__));

        if(getenv('JOOMLA_ENV') === false) {
            $env->load();
        }

        $env->required(['JOOMLA_DB_NAME'])->notEmpty();
        $env->required(['JOOMLA_DB_USER', 'JOOMLA_DB_PASS']);

	    $this->host     = getenv('JOOMLA_DB_HOST');
	    $this->user     = getenv('JOOMLA_DB_USER');
        $this->password = getenv('JOOMLA_DB_PASS');
	    $this->db       = getenv('JOOMLA_DB_NAME');

        $this->log_path  = getenv('JOOMLA_LOG_PATH');
        $this->tmp_path  = getenv('JOOMLA_TMP_PATH');

        $this->secret  = getenv('JOOMLA_KEY');

        /**
         * Load application configuration
         */
        $files  = array(
            'environment.php',
            'environments/'.getenv('JOOMLA_ENV').'.php'
        );

        foreach($files as $file)
        {
            if (file_exists(__DIR__ .'/'. $file))
            {
                $config = require __DIR__ .'/'. $file;

                foreach($config as $key => $value) {
                    $this->$key = $value;
                }
            }
        }

        /**
         * Override application configuration if defined in environment
         */
        if(getenv('JOOMLA_CACHE') !== false) {
            $this->caching = (int) getenv('JOOMLA_CACHE');
        }

        if(getenv('JOOMLA_DEBUG') !== false) {
            $this->debug = (bool) getenv('JOOMLA_DEBUG');
        }
    }
}
