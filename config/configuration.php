<?php
class JConfig
{
    public function __construct()
    {
        /**
         * Load environment configuration
         */
        $env = new \Dotenv\Dotenv(dirname(__DIR__));
        $env->load();
        $env->required(['JOOMLA_DB_NAME', 'JOOMLA_DB_USER', 'JOOMLA_DB_PASS']);

        $this->dbtype   = getenv('JOOMLA_DB_TYPE');
	    $this->host     = getenv('JOOMLA_DB_HOST');
	    $this->user     = getenv('JOOMLA_DB_USER');
        $this->password = getenv('JOOMLA_DB_PASS');
	    $this->db       = getenv('JOOMLA_DB_NAME');

        $this->log_path  = getenv('JOOMLA_LOG_PATH');
        $this->tmp_path  = getenv('JOOMLA_TMP_PATH');

        $this->secret    = getenv('JOOMLA_KEY');

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
    }
}